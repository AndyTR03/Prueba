<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamento';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = false; // Desactivar timestamps si no se usan

    public function usuarioDepartamentos()
    {
        return $this->hasMany(UsuarioDepartamento::class);
    }

    public function Alerta()
    {
        return $this->hasMany(AlertaDepartamento::class, 'departamento_id');
    }
}
