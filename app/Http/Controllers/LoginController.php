<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Método para mostrar la lista de registros en la tabla login con búsqueda
    public function index(Request $request)
    {
        $search = $request->get('search');
        $logins = Login::when($search, function ($query) use ($search) {
            return $query->where('username', 'LIKE', "%$search%")
                         ->orWhere('usuario_id', 'LIKE', "%$search%");
        })->get();

        // Comprobar si la solicitud es AJAX
        if ($request->ajax()) {
            return response()->json(['data' => $logins]);
        }

        return view('login.index', compact('logins', 'search'));
    }

    // Método para crear un nuevo registro en la tabla login
    public function store(LoginRequest $request)
    {
        $login = Login::create($request->validated());
        return response()->json(['data' => $login], 201);
    }

    // Método para actualizar un registro en la tabla login
    public function update(LoginRequest $request, $id)
    {
        $login = Login::findOrFail($id);
        $login->update($request->validated());
        return response()->json(['data' => $login]);
    }

    // Método para eliminar un registro en la tabla login
    public function destroy($id)
    {
        $login = Login::findOrFail($id);
        $login->delete();

        return response()->json(['id' => $id]);
    }
}
