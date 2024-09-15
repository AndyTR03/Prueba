<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlertasDepartamentoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'alerta_id' => 'required|integer|exists:alertas,id',
            'departamento_id' => 'required|integer|exists:departamento,id',
        ];
    }
}

