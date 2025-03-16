@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Lista de Profesores</h2>
        <a href="{{ route('profesores.create') }}" class="btn btn-success mb-3">Agregar Nuevo Profesor</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profesores as $profesor)
                    <tr>
                        <td>{{ $profesor->id }}</td>
                        <td>{{ $profesor->nombre }}</td>
                        <td>{{ $profesor->apellido }}</td>
                        <td>{{ $profesor->email }}</td>
                        <td>
                            <a href="{{ route('profesores.edit', $profesor->id) }}" class="btn btn-warning btn-sm">Editar</a>

                            <form action="{{ route('profesores.destroy', $profesor->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro que deseas eliminar este profesor?');">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
