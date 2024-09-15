<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cambia esto si necesitas autorización
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:usuario,email,' . $this->usuario, // Ignora el usuario actual al actualizar
            'telefono' => 'required|string|max:15',
        ];
    }
}

