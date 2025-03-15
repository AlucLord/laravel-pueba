@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar Grado</h2>
        <form action="{{ route('grados.update', $grado->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Grado</label>
                <input type="text" name="nombre" class="form-control" value="{{ $grado->nombre }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
