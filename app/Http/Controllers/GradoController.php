<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grado;

class GradoController extends Controller
{
    /**
     * Lista de grados.
     */
    public function index()
    {
        $grados = Grado::all();
        return view('grados.index', compact('grados'));
    }

    /**
     * Formulario para crear un nuevo grado.
     */
    public function create()
    {
        return view('grados.create');
    }

    /**
     * Guarda un nuevo grado en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        Grado::create($request->all());

        return redirect()->route('grados.index')->with('success', 'Grado agregado correctamente.');
    }

    /**
     * Formulario para editar un grado.
     */
    public function edit($id)
    {
        $grado = Grado::findOrFail($id);
        return view('grados.edit', compact('grado'));
    }

    /**
     * Actualiza un grado en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $grado = Grado::findOrFail($id);
        $grado->update($request->all());

        return redirect()->route('grados.index')->with('success', 'Grado actualizado correctamente.');
    }

    /**
     * Elimina un grado de la base de datos.
     */
    public function destroy($id)
    {
        $grado = Grado::findOrFail($id);
        $grado->delete();

        return redirect()->route('grados.index')->with('success', 'Grado eliminado correctamente.');
    }
}
