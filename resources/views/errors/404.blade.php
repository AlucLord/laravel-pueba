@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1>Error 404</h1>
        <p>La página que buscas no existe.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Ir al Inicio</a>
    </div>
@endsection
