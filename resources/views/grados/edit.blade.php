@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Editar Grado</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('grados.update', $grado->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Grado</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $grado->nombre }}"
                    required>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('grados.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
