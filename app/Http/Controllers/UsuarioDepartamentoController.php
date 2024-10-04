<?php

namespace App\Http\Controllers;

use App\Models\UsuarioDepartamento;
use App\Http\Requests\UsuarioDepartamentoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Usuario;
use App\Models\Departamento;

class UsuarioDepartamentoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', ''); // Obtener búsqueda desde el request
    
        // Eager loading de relaciones
        $query = UsuarioDepartamento::with(['usuario', 'departamento']);
    
        // Aplicando la búsqueda
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->whereHas('usuario', function($q) use ($search) {
                    $q->where('nombre', 'LIKE', "%$search%")
                      ->orWhere('apellido', 'LIKE', "%$search%");
                })
                ->orWhereHas('departamento', function($q) use ($search) {
                    $q->where('nombre', 'LIKE', "%$search%");
                })
                ->orWhere('id', 'LIKE', "%$search%"); // Búsqueda por ID directamente
            });
        }
    
        // Obteniendo resultados paginados
        $usuariosDepartamentos = $query->paginate(10); // Cambiado a paginate para paginar los resultados
    
        // Verificar si es una solicitud AJAX
        if ($request->ajax()) {
            return response()->json($usuariosDepartamentos);
        }
    
        // Obteniendo todos los usuarios y departamentos
        $usuarios = Usuario::all();
        $departamentos = Departamento::all();
    
        return view('usuario_departamento.index', compact('usuariosDepartamentos', 'search', 'usuarios', 'departamentos'));
    }
    


    public function store(UsuarioDepartamentoRequest $request)
{
    try {
        // Validar los datos
        $validated = $request->validated();

        // Verificar si el usuario ya está en el departamento
        $exists = UsuarioDepartamento::where('usuario_id', $validated['usuario_id'])
                    ->where('departamento_id', $validated['departamento_id'])
                    ->exists();

        if ($exists) {
            return response()->json([
                'status' => 'error',
                'message' => 'El usuario ya está asignado a este departamento.'
            ], 400); // Código de error 400 para solicitudes inválidas
        }

        // Crear el nuevo UsuarioDepartamento
        $usuarioDepartamento = UsuarioDepartamento::create($validated);

        // Eager load el usuario y el departamento
        $usuarioDepartamento->load(['usuario', 'departamento']); 

        // Responder con el modelo completo
        return response()->json(['data' => $usuarioDepartamento->toArray()], 201);

    } catch (\Exception $e) {
        Log::error('Error al crear Usuario por Departamento: ', ['error' => $e->getMessage()]);
        return response()->json([
            'error' => 'Error al crear el Usuario por Departamento.',
            'details' => $e->getMessage()
        ], 500);
    }
}




    public function edit($id)
    {
        // Obtener el usuarioDepartamento por ID
        $usuarioDepartamento = UsuarioDepartamento::with(['usuario', 'departamento'])->findOrFail($id);
    
        // Devolver solo el usuarioDepartamento en el formato especificado
        return response()->json(['data' => $usuarioDepartamento->toArray()], 200); // Cambia el código de estado a 200 OK
    }
    

    public function update(UsuarioDepartamentoRequest $request, $id)
    {
        try {
            // Obtener la instancia del usuarioDepartamento
            $usuarioDepartamento = UsuarioDepartamento::findOrFail($id);
    
            // Validar los datos
            $validated = $request->validated();
    
            // Verificar si el usuario ya está en el nuevo departamento (excepto el mismo registro)
            $exists = UsuarioDepartamento::where('usuario_id', $validated['usuario_id'])
                        ->where('departamento_id', $validated['departamento_id'])
                        ->where('id', '!=', $id) // Ignorar el registro actual
                        ->exists();
    
            if ($exists) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No se puede cambiar de departamento. El usuario ya está asignado a este departamento.'
                ], 400); // Código de error 400
            }
    
            // Actualizar la relación
            $usuarioDepartamento->update($validated);
    
            // Eager load el usuario y el departamento
            $usuarioDepartamento->load(['usuario', 'departamento']);
    
            return response()->json([
                'status' => 'success',
                'data' => $usuarioDepartamento
            ], 200);
    
        } catch (\Exception $e) {
            Log::error('Error al actualizar Usuario por Departamento: ', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Error al actualizar el Usuario por Departamento.',
                'details' => $e->getMessage()
            ], 500);
        }
    }    

    public function destroy($id)
    {
        try {
            $usuarioDepartamento = UsuarioDepartamento::findOrFail($id);
            $usuarioDepartamento->delete();

            return response()->json(['message' => 'Usuario por Departamento eliminado correctamente.'], 200);
        } catch (\Exception $e) {
            Log::error('Error al eliminar Usuario por Departamento: ', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Error al eliminar el Usuario por Departamento.'], 500);
        }
    }
    
}
