@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Crear Nuevo Alumno</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('alumnos.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" name="apellido" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="n_carnet" class="form-label">Número de Carnet</label>
                <input type="text" name="n_carnet" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="grado_id" class="form-label">Grado</label>
                <select name="grado_id" class="form-control" required>
                    <option value="" disabled selected>Seleccione un grado</option>
                    @foreach ($grados as $grado)
                        <option value="{{ $grado['id'] }}">{{ $grado['nombre'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="nombre_padre" class="form-label">Nombre del Padre</label>
                <input type="text" name="nombre_padre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="nombre_madre" class="form-label">Nombre de la Madre</label>
                <input type="text" name="nombre_madre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="edad" class="form-label">Edad</label>
                <input type="number" name="edad" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="nota_final" class="form-label">Nota Final</label>
                <input type="number" name="nota_final" step="0.01" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
