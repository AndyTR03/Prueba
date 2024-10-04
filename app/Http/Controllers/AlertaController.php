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

    public function store(Request $request)
    {
        $request->validate([
            'mensaje' => 'required|string|max:255',
            'destinatario_tipo' => 'required|in:usuario,departamento',
            'usuarios' => 'required_if:destinatario_tipo,usuario|array',
            'departamentos' => 'required_if:destinatario_tipo,departamento|array',
        ]);

        // Crear la alerta en la base de datos
        $alerta = Alerta::create([
            'mensaje' => $request->input('mensaje'),
            'fecha_creacion' => now(),
        ]);

        // Inicializa el array para los resultados de envío
        $resultadosEnvio = [];

        // Lógica para enviar mensajes
        $phoneUtil = PhoneNumberUtil::getInstance();
        $defaultRegion = 'PE'; // Cambia esto por tu país predeterminado
        $token = "8655aoLGyAXLt1EcaETHHOf2Rk1Ifj"; // Tu token
        $url = "https://andy.senati.buho.xyz/api/message/send-text"; // URL de la API

        // Obtener los números de teléfono según el tipo de destinatario
        if ($request->input('destinatario_tipo') === 'usuario') {
            $usuarios = $request->input('usuarios');
            foreach ($usuarios as $usuarioId) {
                $usuario = Usuario::find($usuarioId);
                if ($usuario) {
                    $telefono = $usuario->telefono;
                    $resultadoEnvio = $this->enviarMensaje($telefono, $alerta->mensaje, $phoneUtil, $defaultRegion, $token, $url);
                    $resultadosEnvio[] = ['telefono' => $telefono, 'resultado' => $resultadoEnvio];
                }
            }
        } elseif ($request->input('destinatario_tipo') === 'departamento') {
            $departamentos = $request->input('departamentos');
            foreach ($departamentos as $departamentoId) {
                $usuariosDelDepartamento = UsuarioDepartamento::where('departamento_id', $departamentoId)->pluck('usuario_id');
                foreach ($usuariosDelDepartamento as $usuarioId) {
                    $usuario = Usuario::find($usuarioId);
                    if ($usuario) {
                        $telefono = $usuario->telefono;
                        $resultadoEnvio = $this->enviarMensaje($telefono, $alerta->mensaje, $phoneUtil, $defaultRegion, $token, $url);
                        $resultadosEnvio[] = ['telefono' => $telefono, 'resultado' => $resultadoEnvio];
                    }
                }
            }
        }

        return response()->json([
            'id' => $alerta->id,
            'mensaje' => $alerta->mensaje,
            'fecha_creacion' => $alerta->fecha_creacion->format('Y-m-d H:i:s'),
            'resultadosEnvio' => $resultadosEnvio,
        ]);
    }

    private function enviarMensaje($telefono, $mensaje, $phoneUtil, $defaultRegion, $token, $url)
    {
        $formattedNumber = '';

        try {
            // Si el número no comienza con un prefijo internacional, añadir el código de país
            if (!preg_match('/^\+?\d+$/', $telefono)) {
                $telefono = '+51' . $telefono; // Cambia esto por el código de país que corresponda
            }

            // Intenta analizar el número ingresado
            $phoneNumber = $phoneUtil->parse($telefono, $defaultRegion);

            // Validar si el número es posible
            if (!$phoneUtil->isValidNumber($phoneNumber)) {
                return ['error' => 'Número no válido'];
            }

            // Formatear el número a formato internacional
            $formattedNumber = $phoneUtil->format($phoneNumber, \libphonenumber\PhoneNumberFormat::E164);

            // Enviar la solicitud a la API
            $response = Http::withHeaders([
                'Authorization' => "Bearer $token",
                'Content-Type' => 'application/json'
            ])->post($url, [
                'number' => $formattedNumber,
                'message' => $mensaje,
            ]);

            if ($response->successful()) {
                return ['success' => true];
            } else {
                return ['error' => 'Error en la API: ' . $response->body()];
            }
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