@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Lista de Alumnos</h2>
        <a href="{{ route('alumnos.create') }}" class="btn btn-warning mb-3">Agregar Nuevo Alumno</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>N° Carnet</th>
                    <th>Grado</th>
                    <th>Nota Final</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->id }}</td>
                        <td>{{ $alumno->nombre }}</td>
                        <td>{{ $alumno->apellidos }}</td>
                        <td>{{ $alumno->n_carnet }}</td>
                        <td>{{ $alumno->grado->nombre }}</td>
                        <td>{{ $alumno->nota_final }}</td>
                        <td>
                            <a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Eliminar este alumno?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
