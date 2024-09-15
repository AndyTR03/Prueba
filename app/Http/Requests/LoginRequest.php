<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'usuario_id' => 'required|integer|exists:usuario,id',
            'username' => 'required|string|max:255',
            'password' => 'required|string',
        ];
    }
}
