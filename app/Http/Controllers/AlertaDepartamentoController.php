<?php

namespace App\Http\Controllers;

use App\Models\AlertaDepartamento;
use Illuminate\Http\Request;

class AlertaDepartamentoController extends Controller
{
    public function index()
{
    // Carga las relaciones para evitar null
    $alertasDepartamentos = AlertaDepartamento::with(['alerta', 'departamento'])->get();

    return view('alertas_departamento.index', compact('alertasDepartamentos'));
}

}
