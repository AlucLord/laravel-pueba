@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar Profesor</h2>
        <form action="{{ route('profesores.update', $profesor->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $profesor->nombre }}" required>
            </div>
            <div class="mb-3">
                <label for="especialidad" class="form-label">Especialidad</label>
                <input type="text" name="especialidad" class="form-control" value="{{ $profesor->especialidad }}"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
