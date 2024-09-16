<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioDepartamentoRequest extends FormRequest
{
    public function authorize()
    {
        // Permitir todos los usuarios a hacer esta solicitud
        return true;
    }

    public function rules()
    {
        return [
            'usuario_id' => 'required|exists:usuario,id', // Corregido: debe ser 'usuario' en plural
            'departamento_id' => 'required|exists:departamento,id', // Corregido: debe ser 'departamento' en plural
        ];
    }

    public function messages()
    {
        return [
            'usuario_id.required' => 'El usuario es requerido.',
            'usuario_id.exists' => 'El usuario seleccionado no es válido.',
            'departamento_id.required' => 'El departamento es requerido.',
            'departamento_id.exists' => 'El departamento seleccionado no es válido.',
        ];
    }
}
