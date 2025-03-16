@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h2 class="mb-4">📚 Gestión Académica 📚</h2>

        <div class="row justify-content-center">
            <div class="col-md-3 mb-3">
                <a href="{{ route('grados.index') }}" class="btn btn-primary btn-lg btn-block shadow">
                    📘 Gestión de Grados
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('profesores.index') }}" class="btn btn-success btn-lg btn-block shadow">
                    👨‍🏫 Gestión de Profesores
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('alumnos.index') }}" class="btn btn-warning btn-lg btn-block shadow">
                    🎓 Gestión de Alumnos
                </a>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('alumnos.report') }}" class="btn btn-danger btn-lg shadow">
                📊 Generar Reporte
            </a>
        </div>
    </div>
@endsection
