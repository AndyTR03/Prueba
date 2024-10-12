<?php

namespace App\Http\Controllers;

use App\Models\AlertaUsuario;
use Illuminate\Http\Request;

class AlertaUsuarioController extends Controller
{
    public function index()
    {
        // Cargar las relaciones para evitar N+1
        $alertasUsuarios = AlertaUsuario::with(['alerta', 'usuario'])->get();
        
        // Pasar datos a la vista
        return view('alertas_usuario.index', compact('alertasUsuarios'));
    }
}
