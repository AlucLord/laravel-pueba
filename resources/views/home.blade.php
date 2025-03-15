@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div class="text-center">
        <h2>Gestión Académica</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <a href="{{ route('grados.index') }}" class="btn btn-primary btn-lg">Gestión de Grados</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('profesores.index') }}" class="btn btn-success btn-lg">Gestión de Profesores</a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('alumnos.index') }}" class="btn btn-warning btn-lg">Gestión de Alumnos</a>
            </div>
        </div>
    </div>
@endsection
