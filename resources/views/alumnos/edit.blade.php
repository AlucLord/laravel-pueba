@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar Alumno</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('alumnos.update', $alumno->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $alumno->nombre }}" required>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" name="apellido" class="form-control" value="{{ $alumno->apellido }}" required>
            </div>

            <div class="mb-3">
                <label for="n_carnet" class="form-label">Número de Carnet</label>
                <input type="text" name="n_carnet" class="form-control" value="{{ $alumno->n_carnet }}" required>
            </div>

            <div class="mb-3">
                <label for="grado_id" class="form-label">Grado</label>
                <select name="grado_id" class="form-control" required>
                    @foreach ($grados as $grado)
                        <option value="{{ $grado->id }}" {{ $grado->id == $alumno->grado_id ? 'selected' : '' }}>
                            {{ $grado->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="nombre_padre" class="form-label">Nombre del Padre</label>
                <input type="text" name="nombre_padre" class="form-control" value="{{ $alumno->nombre_padre }}" required>
            </div>

            <div class="mb-3">
                <label for="nombre_madre" class="form-label">Nombre de la Madre</label>
                <input type="text" name="nombre_madre" class="form-control" value="{{ $alumno->nombre_madre }}" required>
            </div>

            <div class="mb-3">
                <label for="edad" class="form-label">Edad</label>
                <input type="number" name="edad" class="form-control" value="{{ $alumno->edad }}" required>
            </div>

            <div class="mb-3">
                <label for="nota_final" class="form-label">Nota Final</label>
                <input type="number" name="nota_final" step="0.01" class="form-control"
                    value="{{ $alumno->nota_final }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
