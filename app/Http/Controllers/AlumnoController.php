<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\Grado;
use Nette\Utils\Floats;
use App\Http\Controllers\QueryException;

class AlumnoController extends Controller
{
    /**
     * Muestra la lista de alumnos.
     */
    public function index()
    {
        $alumnos = Alumno::with('grado')->get();
        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Muestra el formulario para crear un nuevo alumno.
     */
    public function create()
    {
        $grados = [
            ['id' => 1, 'nombre' => 'Primero'],
            ['id' => 2, 'nombre' => 'Segundo'],
            ['id' => 3, 'nombre' => 'Tercero'],
            ['id' => 4, 'nombre' => 'Cuarto'],
            ['id' => 5, 'nombre' => 'Quinto'],
            ['id' => 6, 'nombre' => 'Sexto'],
            ['id' => 7, 'nombre' => 'Séptimo'],
            ['id' => 8, 'nombre' => 'Octavo'],
            ['id' => 9, 'nombre' => 'Noveno']
        ];
        return view('alumnos.create', compact('grados'));
    }

    /**
     * Almacena un nuevo alumno en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'n_carnet' => 'required|unique:alumnos',
            'grado_id' => 'required|integer|min:1|max:9',
            'nombre_padre' => 'required',
            'nombre_madre' => 'required',
            'edad' => 'required|integer|min:3',
            'nota_final' => 'required|numeric|min:0|max:10',
        ]);

        Alumno::create($request->all());
        return redirect()->route('alumnos.index')->with('success', 'Alumno creado correctamente.');
    }

    public function edit($id)
    {
        $alumno = Alumno::findOrFail($id);
        $grados = Grado::all();
        return view('alumnos.edit', compact('alumno', 'grados'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'n_carnet' => 'required|unique:alumnos,n_carnet,' . $id,
            'grado_id' => 'required|integer|exists:grados,id',
            'nombre_padre' => 'required',
            'nombre_madre' => 'required',
            'edad' => 'required|integer|min:3',
            'nota_final' => 'required|numeric|min:0|max:10',
        ]);

        $alumno = Alumno::findOrFail($id);
        $alumno->update($request->all());

        return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado correctamente.');
    }

    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->delete();

        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado correctamente');
    }
}
