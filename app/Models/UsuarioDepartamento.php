<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioDepartamento extends Model
{
    use HasFactory;

    protected $table = 'usuario_departamento';

    protected $fillable = [
        'usuario_id',
        'departamento_id',
    ];

    public $timestamps = false; // Desactivar timestamps si no se usan

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id'); // Asegúrate de que el nombre del campo es correcto
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id'); // Asegúrate de que el nombre del campo es correcto
    }
}

