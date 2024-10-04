<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlertasRequest extends FormRequest
{
    public function rules()
    {
        return [
            'mensaje' => 'required|string|max:255',
            'fecha_creacion' => 'required|date',
            'departamentos' => 'sometimes|array',
            'departamentos.*' => 'exists:departamento,id', // Ensures that each selected department exists
            'usuarios' => 'sometimes|array',
            'usuarios.*' => 'exists:usuario,id', // Ensures that each selected user exists
        ];
    }

    public function messages()
    {
        return [
            'departamentos.*.exists' => 'The selected department is invalid.',
            'usuarios.*.exists' => 'The selected user is invalid.',
        ];
    }


    protected function prepareForValidation()
    {
        // Combinar la fecha con la hora actual antes de validar
        if ($this->has('fecha_creacion')) {
            $this->merge([
                'fecha_creacion' => $this->fecha_creacion . ' ' . now()->format('H:i:s'),
            ]);
        }
    }
}
