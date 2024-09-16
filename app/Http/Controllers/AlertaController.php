<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use App\Http\Requests\AlertasRequest;
use Illuminate\Http\Request;

class AlertaController extends Controller
{

   // Método para mostrar la lista de alertas en la tabla login con búsqueda
    public function index(Request $request)
    {
        $search = $request->get('search');
        $alertas = Alerta::when($search, function ($query) use ($search) {
            return $query->where('id', 'LIKE', "%$search%")
                         ->orwhere('mensaje', 'LIKE', "%$search%")
                         ->orwhere('fecha_creacion', 'LIKE', "%$search%");
        })->get();

        // Comprobar si la solicitud es AJAX
        if ($request->ajax()) {
            return response()->json(['data' => $alertas]);
        }

        return view('alertas.index', compact('alertas', 'search'));
    }

    // Método para crear un nuevo registro en la tabla login
    public function store(AlertasRequest $request)
    {
        // Crea la alerta usando el request ya modificado
        $alerta = Alerta::create($request->validated());

        return response()->json(['data' => $alerta], 201);
    }



    // Método para actualizar un registro en la tabla login
    public function update(AlertasRequest $request, $id)
    {
        $alerta = Alerta::findOrFail($id);
        $alerta->update($request->validated());
        return response()->json(['data' => $alerta]);
    }

    // Método para eliminar un registro en la tabla login
    public function destroy($id)
    {
        $alerta = Alerta::findOrFail($id); // Encuentra la alerta por ID
        $alerta->delete(); // Elimina la alerta
    
        return response()->json(['id' => $id]); // Retorna una respuesta JSON
    }
    
}

