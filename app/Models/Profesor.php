<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $fillable = ['nombre', 'apellido', 'especialidad'];

    // Relación con Grado (un profesor puede tener muchos grados)
    public function grados()
    {
        return $this->hasMany(Grado::class);
    }
}
