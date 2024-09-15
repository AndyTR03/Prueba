<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlertasRequest extends FormRequest
{
    public function rules()
    {
        return [
            'mensaje' => 'required|string',
            'fecha_creacion' => 'required|date',
        ];
    }
}
