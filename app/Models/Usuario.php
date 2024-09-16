<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
    ];

    public $timestamps = false; // Desactivar timestamps si no se usan

    public function usuarioDepartamentos()
    {
        return $this->hasMany(UsuarioDepartamento::class);
    }
}
