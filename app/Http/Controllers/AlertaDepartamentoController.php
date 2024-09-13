<?php

namespace App\Http\Controllers;

use App\Models\AlertaDepartamento;
use Illuminate\Http\Request;

class AlertaDepartamentoController extends Controller
{
    public function index()
    {
        $alertasDepartamentos = AlertaDepartamento::all();
        return view('alertas_departamento.index', compact('alertasDepartamentos'));
    }
}
