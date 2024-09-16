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

            // Crear el nuevo UsuarioDepartamento
            $usuarioDepartamento = UsuarioDepartamento::create($validated);

            // Eager load el usuario y el departamento
            $usuarioDepartamento->load(['usuario', 'departamento']); 

            // Responder con el modelo completo, incluyendo usuario y departamento
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
        $usuarioDepartamento = UsuarioDepartamento::findOrFail($id);
        $usuarioDepartamento->update($request->validated());
        
        // Eager load el usuario y el departamento
        $usuarioDepartamento->load(['usuario', 'departamento']);
    
        return response()->json(['data' => $usuarioDepartamento], 200);
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
