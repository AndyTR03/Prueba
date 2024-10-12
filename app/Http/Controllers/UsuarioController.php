<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\AlertaUsuario;
use App\Models\UsuarioDepartamento;
class UsuarioController extends Controller
{
    // Método para mostrar la lista de usuarios con búsqueda
    public function index(Request $request)
    {
        $search = $request->get('search');
        $usuarios = Usuario::when($search, function ($query) use ($search) {
            return $query->where('nombre', 'LIKE', "%$search%")
                         ->orWhere('apellido', 'LIKE', "%$search%")
                         ->orWhere('email', 'LIKE', "%$search%");
        })->get();

        // Comprobar si la solicitud es AJAX
        if ($request->ajax()) {
            return response()->json(['data' => $usuarios]);
        }

        return view('usuario.index', compact('usuarios', 'search'));
    }

    // Método para crear un nuevo usuario
    public function store(UsuarioRequest $request)
    {
        $usuario = Usuario::create($request->validated());
        return response()->json(['data' => $usuario], 201);
    }

    // Método para actualizar un usuario
    public function update(UsuarioRequest $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->validated());
        return response()->json(['data' => $usuario]);
    }

    public function destroy($id)
    {
        // Encuentra el usuario
        $usuario = Usuario::findOrFail($id);
    
        // Elimina los registros relacionados de las tablas conectadas
        // Eliminar registros en la tabla login
        Login::where('usuario_id', $id)->delete();
    
        // Eliminar registros en la tabla alertas_usuario
        AlertaUsuario::where('usuario_id', $id)->delete();
    
        // Eliminar registros en la tabla usuario_departamento
        UsuarioDepartamento::where('usuario_id', $id)->delete();
    
        // Ahora elimina el usuario
        $usuario->delete();
    
        return response()->json(['success' => 'Usuario y datos relacionados eliminados correctamente.']);
    }
    

    
}
