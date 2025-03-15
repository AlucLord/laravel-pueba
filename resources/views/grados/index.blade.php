@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Lista de Grados</h2>
        <a href="{{ route('grados.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Grado</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grados as $grado)
                    <tr>
                        <td>{{ $grado->id }}</td>
                        <td>{{ $grado->nombre }}</td>
                        <td>
                            <a href="{{ route('grados.edit', $grado->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('grados.destroy', $grado->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Eliminar este grado?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
