<?php

namespace App\Http\Controllers;

use App\Models\UsuarioDepartamento;
use Illuminate\Http\Request;

class UsuarioDepartamentoController extends Controller
{
    public function index()
    {
        $usuariosDepartamentos = UsuarioDepartamento::all();
        return view('usuario_departamento.index', compact('usuariosDepartamentos'));
    }
}
