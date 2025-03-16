<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    protected $table = 'profesors';

    protected $fillable = ['nombre', 'apellido', 'grado_id', 'edad', 'sexo', 'titulo'];

    /**
     * Relación con Grado.
     */
    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }
}
