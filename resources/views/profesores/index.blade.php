@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Lista de Profesores</h2>
        <a href="{{ route('profesores.create') }}" class="btn btn-success mb-3">Agregar Nuevo Profesor</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Grado</th>
                    <th>Edad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profesores as $profesor)
                    <tr>
                        <td>{{ $profesor->id }}</td>
                        <td>{{ $profesor->nombre }}</td>
                        <td>{{ $profesor->apellidos }}</td>
                        <td>{{ $profesor->grado->nombre }}</td>
                        <td>{{ $profesor->edad }}</td>
                        <td>
                            <a href="{{ route('profesores.edit', $profesor->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('profesores.destroy', $profesor->id) }}" method="POST"
                                style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Eliminar este profesor?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
