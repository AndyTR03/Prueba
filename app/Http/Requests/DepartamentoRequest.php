<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartamentoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
        ];
    }
}
