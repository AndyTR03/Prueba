<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlertasRequest extends FormRequest
{
    public function rules()
    {
        return [
            'mensaje' => 'required|string|max:255',
            'fecha_creacion' => 'required|date', // Asegúrate de que esto esté aquí
        ];
    }

    protected function prepareForValidation()
    {
        // Aquí puedes combinar la fecha con la hora antes de validar
        if ($this->has('fecha_creacion')) {
            $this->merge([
                'fecha_creacion' => $this->fecha_creacion . ' ' . now()->format('H:i:s'), // Combina la fecha con la hora actual
            ]);
        }
    }
}
