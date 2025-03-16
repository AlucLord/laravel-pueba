<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    protected $fillable = ['nombre'];

    // Relación con Alumno (un grado tiene muchos alumnos)
    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }
}
