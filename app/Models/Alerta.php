<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    protected $table = 'alertas';  // Opcional, ya que sigue la convención de nombre
    protected $fillable = ['mensaje', 'fecha_creacion'];

    // Desactivar timestamps automáticos
    public $timestamps = false;
    // Relación muchos a muchos con Departamentos a través de AlertaDepartamento
    
    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'alerta_usuarios');
    }

    public function departamentos()
    {
        return $this->belongsToMany(Departamento::class, 'alerta_departamentos');
    }

}
