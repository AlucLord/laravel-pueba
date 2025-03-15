<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $fillable = [
        'nombre', 'apellido', 'n_carnet', 'grado_id',
        'nombre_padre', 'nombre_madre', 'edad', 'nota_final'
    ];

    // Definir la relación con Grado
    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }
}
