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

    public function alertasUsuario()
    {
        return $this->hasMany(AlertaUsuario::class, 'usuario_id');
    }

    public function login()
    {
        return $this->hasOne(Login::class, 'usuario_id');
    }

    public function usuarioDepartamento()
    {
        return $this->hasMany(UsuarioDepartamento::class, 'usuario_id');
    }
    
    public function Alerta()
    {
        return $this->hasMany(AlertaUsuario::class, 'usuario_id');
    }

}
