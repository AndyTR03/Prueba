<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    protected $table = 'login';

    protected $fillable = [
        'usuario_id',
        'username',
        'password',
    ];

    public $timestamps = false; // Desactivar timestamps si no se usan
}
