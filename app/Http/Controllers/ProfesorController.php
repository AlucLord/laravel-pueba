<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor;
use App\Models\Grado;

class ProfesorController extends Controller
{
    /**
     * Lista de profesores.
     */
    public function index()
    {
        $profesores = Profesor::with('grado')->get();
        return view('profesores.index', compact('profesores'));
    }

    /**
     * Formulario para crear un nuevo profesor.
     */
    public function create()
    {
        $grados = Grado::all();
        return view('profesores.create', compact('grados'));
    }

    /**
     * Guarda un nuevo profesor en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'grado_id' => 'required|exists:grados,id',
            'edad' => 'required|integer|min:18',
            'sexo' => 'required|integer',
            'titulo' => 'required|string|max:255',
        ]);

        Profesor::create($request->all());

        return redirect()->route('profesores.index')->with('success', 'Profesor agregado correctamente.');
    }

    /**
     * Formulario para editar un profesor.
     */
    public function edit($id)
    {
        $profesor = Profesor::findOrFail($id);
        $grados = Grado::all();
        return view('profesores.edit', compact('profesor', 'grados'));
    }

    /**
     * Actualiza un profesor en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'grado_id' => 'required|exists:grados,id',
            'edad' => 'required|integer|min:18',
            'sexo' => 'required|integer',
            'titulo' => 'required|string|max:255',
        ]);

        $profesor = Profesor::findOrFail($id);
        $profesor->update($request->all());

        return redirect()->route('profesores.index')->with('success', 'Profesor actualizado correctamente.');
    }

    /**
     * Elimina un profesor de la base de datos.
     */
    public function destroy($id)
    {
        $profesor = Profesor::findOrFail($id);
        $profesor->delete();

        return redirect()->route('profesores.index')->with('success', 'Profesor eliminado correctamente.');
    }
}
