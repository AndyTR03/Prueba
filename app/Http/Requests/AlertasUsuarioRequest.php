<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlertasUsuarioRequest extends FormRequest
{
    public function rules()
    {
        return [
            'alerta_id' => 'required|integer|exists:alertas,id',
            'usuario_id' => 'required|integer|exists:usuario,id',
        ];
    }
}

