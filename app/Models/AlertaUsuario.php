<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertaUsuario extends Model
{
    use HasFactory;

    protected $table = 'alertas_usuario';

    protected $fillable = [
        'alerta_id',
        'usuario_id',
    ];

    public $timestamps = false; // Desactivar timestamps si no se usan
}
