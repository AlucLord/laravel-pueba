<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor;


class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profesores = Profesor::with('grado')->get();
        return view('profesores.index', compact('profesores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'grado_id' => 'required|exists:grados,id',
            'edad' => 'required|integer',
            'sexo' => 'required',
            'titulo' => 'required'
        ]);

        $profesor = Profesor::create($request->all());
        return response()->json($profesor, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Profesor::with('grado')->findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $profesor = Profesor::findOrFail($id);
        $profesor->update($request->all());
        return response()->json($profesor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Profesor::destroy($id);
        return response()->json(['message' => 'Profesor eliminado']);
    }
}
