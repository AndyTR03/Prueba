<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    use HasFactory;

    protected $table = 'alertas';

    protected $fillable = [
        'mensaje',
        'fecha_creacion',
    ];

    public $timestamps = false; // Desactivar timestamps si no se usan
}
