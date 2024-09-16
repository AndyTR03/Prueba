<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Http\Requests\DepartamentoRequest;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
   // Método para mostrar la lista de registros en la tabla login con búsqueda
    public function index(Request $request)
    {
        $search = $request->get('search');
        $departamentos = Departamento::when($search, function ($query) use ($search) {
            return $query->where('id', 'LIKE', "%$search%")
                         ->orwhere('nombre', 'LIKE', "%$search%");
        })->get();

        // Comprobar si la solicitud es AJAX
        if ($request->ajax()) {
            return response()->json(['data' => $departamentos]);
        }

        return view('departamento.index', compact('departamentos', 'search'));
    }

    // Método para crear un nuevo registro en la tabla login
    public function store(DepartamentoRequest $request)
    {
        $login = Departamento::create($request->validated());
        return response()->json(['data' => $login], 201);
    }

    // Método para actualizar un registro en la tabla login
    public function update(DepartamentoRequest $request, $id)
    {
        $login = Departamento::findOrFail($id);
        $login->update($request->validated());
        return response()->json(['data' => $login]);
    }

    // Método para eliminar un registro en la tabla login
    public function destroy($id)
    {
        $login = Departamento::findOrFail($id);
        $login->delete();

        return response()->json(['id' => $id]);
    }
}
