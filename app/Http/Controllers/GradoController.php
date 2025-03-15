<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grado;

class GradoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grados = Grado::all();
        return view('grados.index', compact('grados'));
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
            'nombre' => 'require|unique:grados'
        ]);

        $grado = Grado::create($request->all());
        return response()->json($grado, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Grado::findOrFail($id));
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
        $grado = Grado::findOrFail($id);
        $grado->update($request->all());
        return response()->json($grado);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Grado::destroy($id);
        return response()->json(['message' => 'Grado eliminado']);
    }
}
