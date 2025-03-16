@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Editar Profesor</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profesores.update', $profesor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $profesor->nombre }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="form-control" value="{{ $profesor->apellido }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="grado_id" class="form-label">Grado</label>
                <select name="grado_id" id="grado_id" class="form-control" required>
                    @foreach ($grados as $grado)
                        <option value="{{ $grado->id }}" {{ $profesor->grado_id == $grado->id ? 'selected' : '' }}>
                            {{ $grado->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="edad" class="form-label">Edad</label>
                <input type="number" name="edad" id="edad" class="form-control" value="{{ $profesor->edad }}"
                    required min="18">
            </div>

            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select name="sexo" id="sexo" class="form-control" required>
                    <option value="1" {{ $profesor->sexo == 1 ? 'selected' : '' }}>Masculino</option>
                    <option value="2" {{ $profesor->sexo == 2 ? 'selected' : '' }}>Femenino</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $profesor->titulo }}"
                    required>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('profesores.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
