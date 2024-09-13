<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertaDepartamento extends Model
{
    use HasFactory;

    protected $table = 'alertas_departamento';

    protected $fillable = [
        'alerta_id',
        'departamento_id',
    ];

    public $timestamps = false; // Desactivar timestamps si no se usan
}
