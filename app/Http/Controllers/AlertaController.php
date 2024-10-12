<?php

namespace App\Http\Controllers;

use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Alerta;
use App\Models\AlertaDepartamento;
use App\Models\AlertaUsuario;
use App\Models\Usuario;
use App\Models\Departamento;
use App\Models\UsuarioDepartamento;
use App\Jobs\EnviarMensajeJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AlertaController extends Controller
{
    
    public function index(Request $request)
    {
        $search = $request->input('search');
        // Cambia get() por paginate(10) para paginar los resultados
        $alertas = Alerta::where('mensaje', 'LIKE', "%$search%")->paginate(10); // Cambia 10 por el número de resultados por página que desees
        
        $usuarios = Usuario::all();
        $departamentos = Departamento::all();
    
        return view('alertas.index', compact('alertas', 'usuarios', 'departamentos'));
    }
    
    private function getApiConfig()
    {
        // Leer la configuración actual desde el archivo JSON
        $config = json_decode(Storage::get('api_config.json'), true);

        // Validar que la configuración sea correcta
        if (!$config || !isset($config['token']) || !isset($config['url'])) {
            abort(500, 'Configuración API no válida o no encontrada.');
        }

        return $config;
    }

    public function store(Request $request)
{
    $request->validate([
        'mensaje' => 'required|string|max:255',
        'destinatario_tipo' => 'required|in:usuario,departamento',
        'usuarios' => 'required_if:destinatario_tipo,usuario|array',
        'departamentos' => 'required_if:destinatario_tipo,departamento|array',
        'fecha_creacion' => 'nullable|date',
        'archivo' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx,ppt,pptx|max:10000',
    ]);

    $fechaCreacion = $request->input('fecha_creacion')
        ? Carbon::parse($request->input('fecha_creacion'))->setTimezone('America/Lima') 
        : Carbon::now('America/Lima');

    $alerta = Alerta::create([
        'mensaje' => $request->input('mensaje'),
        'fecha_creacion' => $fechaCreacion,
    ]);

    $resultadosEnvio = [];

    $phoneUtil = PhoneNumberUtil::getInstance();
    $defaultRegion = 'PE'; // Cambia esto por tu país predeterminado
    $textConfig = json_decode(Storage::get('api_config_text.json'), true);
    $tokenTexto = $textConfig['token'] ?? 'valor_default_token'; // Token para mensajes de texto
    $urlTexto = $textConfig['url'] ?? 'valor_default_url'; // URL de la API para mensajes de texto

    // Obtener la configuración de envío de archivos
    $fileConfig = json_decode(Storage::get('api_config_file.json'), true);
    $tokenArchivo = $fileConfig['token'] ?? 'valor_default_token_archivo'; // Token fijo para archivos
    $urlArchivo = $fileConfig['url'] ?? 'valor_default_url_archivo'; // URL fija para archivos

    // Manejo del archivo (si existe)
    $archivoAdjunto = null;
    $nombreArchivo = null;
    if ($request->hasFile('archivo')) {
        $archivo = $request->file('archivo');
        $archivoAdjunto = base64_encode(file_get_contents($archivo));
        $nombreArchivo = $archivo->getClientOriginalName();
    }

    // Inicializar el array de usuarios
    $usuarios = [];
    if ($request->input('destinatario_tipo') === 'usuario') {
        $usuarios = $request->input('usuarios');
    } elseif ($request->input('destinatario_tipo') === 'departamento') {
        $departamentos = $request->input('departamentos');
        foreach ($departamentos as $departamentoId) {
            $usuariosDelDepartamento = UsuarioDepartamento::where('departamento_id', $departamentoId)->pluck('usuario_id');
            $usuarios = array_merge($usuarios, $usuariosDelDepartamento->toArray());
            
            // Guardar la relación en alerta_departamento
            AlertaDepartamento::create([
                'alerta_id' => $alerta->id,
                'departamento_id' => $departamentoId,
            ]);
        }
    }

    // Eliminar duplicados de usuarios
    $usuarios = array_unique($usuarios);

    // Programar el envío
    foreach ($usuarios as $usuarioId) {
        $usuario = Usuario::find($usuarioId);
        if ($usuario) {
            $telefono = $usuario->telefono;

            // Aquí se guarda la relación en la tabla alerta_usuarios
            AlertaUsuario::create([
                'alerta_id' => $alerta->id,
                'usuario_id' => $usuarioId,
            ]);

            $this->programarEnvio($telefono, $alerta->mensaje, $archivoAdjunto, $nombreArchivo, $fechaCreacion, $phoneUtil, $defaultRegion, $tokenTexto, $tokenArchivo, $urlTexto, $urlArchivo);
            $resultadosEnvio[] = ['telefono' => $telefono, 'estado' => 'Programado'];
        }
    }

    return response()->json([
        'id' => $alerta->id,
        'mensaje' => $alerta->mensaje,
        'fecha_creacion' => $alerta->fecha_creacion->format('Y-m-d H:i:s'),
        'resultadosEnvio' => $resultadosEnvio,
    ]);
}

    private function programarEnvio($telefono, $mensaje, $archivoAdjunto, $nombreArchivo, $fechaCreacion, $phoneUtil, $defaultRegion, $tokenTexto, $tokenArchivo, $urlTexto, $urlArchivo)
    {
        if ($fechaCreacion->isFuture()) {
            EnviarMensajeJob::dispatch($telefono, $mensaje, $archivoAdjunto, $nombreArchivo, $tokenTexto, $tokenArchivo, $urlTexto, $urlArchivo, $defaultRegion)
                ->delay($fechaCreacion);
        } else {
            $this->enviarMensaje($telefono, $mensaje, $archivoAdjunto, $nombreArchivo, $phoneUtil, $defaultRegion, $tokenTexto, $tokenArchivo, $urlTexto, $urlArchivo);
        }
    }

    private function enviarMensaje($telefono, $mensaje, $archivoAdjunto, $nombreArchivo, $phoneUtil, $defaultRegion, $tokenTexto, $tokenArchivo, $urlTexto, $urlArchivo)
    {
        $formattedNumber = '';

        try {
            if (!preg_match('/^\+?\d+$/', $telefono)) {
                $telefono = '+' . $telefono; 
            }

            $phoneNumber = $phoneUtil->parse($telefono, $defaultRegion);

            if (!$phoneUtil->isValidNumber($phoneNumber)) {
                return ['error' => 'Número no válido'];
            }

            $formattedNumber = $phoneUtil->format($phoneNumber, \libphonenumber\PhoneNumberFormat::E164);

            // Enviar archivo si está adjunto
            if ($archivoAdjunto) {
                $responseArchivo = Http::withHeaders([
                    'Authorization' => "Bearer $tokenArchivo",
                    'Content-Type' => 'application/json',
                ])->post($urlArchivo, [
                    'number' => $formattedNumber,
                    'message' => $mensaje,
                    'file' => $archivoAdjunto,
                    'filename' => $nombreArchivo,
                ]);

                if ($responseArchivo->failed()) {
                    return ['error' => 'Error en la API de archivo: ' . $responseArchivo->body()];
                }
            } else {
                // Solo enviar mensaje de texto si no hay archivo adjunto
                $responseTexto = Http::withHeaders([
                    'Authorization' => "Bearer $tokenTexto",
                    'Content-Type' => 'application/json'
                ])->post($urlTexto, [
                    'number' => $formattedNumber,
                    'message' => $mensaje,
                ]);

                if ($responseTexto->failed()) {
                    return ['error' => 'Error en la API de texto: ' . $responseTexto->body()];
                }
            }

            return ['success' => true];
        } catch (NumberParseException $e) {
            return ['error' => 'Error al analizar el número: ' . $e->getMessage()];
        }
    }

    

    public function update(Request $request, $id)
    {
        $request->validate([
            'mensaje' => 'required|string|max:255',
        ]);

        $alerta = Alerta::findOrFail($id);
        $alerta->mensaje = $request->mensaje;
        $alerta->save();

        return response()->json([
            'id' => $alerta->id,
            'mensaje' => $alerta->mensaje,
            'fecha_creacion' => $alerta->fecha_creacion
        ]);
    }


    
    public function destroy($id)
    {
        // Buscar la alerta
        $alerta = Alerta::findOrFail($id);
    
        // Eliminar las relaciones con usuarios
        AlertaUsuario::where('alerta_id', $id)->delete();
    
        // Eliminar las relaciones con departamentos
        AlertaDepartamento::where('alerta_id', $id)->delete();
    
        // Finalmente, eliminar la alerta
        $alerta->delete();
    
        return response()->json(['id' => $id]);
    } 

    
}