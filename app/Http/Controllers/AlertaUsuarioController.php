<?php

namespace App\Http\Controllers;

use App\Models\AlertaUsuario;
use Illuminate\Http\Request;

class AlertaUsuarioController extends Controller
{
    public function index()
    {
        $alertasUsuarios = AlertaUsuario::all();
        return view('alertas_usuario.index', compact('alertasUsuarios'));
    }
}
