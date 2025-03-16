<?php

use App\Exports\AlumnosExport;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\ProfesorController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return view('home');
})->name('home');

//Ruta para exportar
Route::get('/alumnos/reporte', [AlumnoController::class, 'export'])->name('alumnos.report');

// Verificar si los controladores existen antes de definir rutas
if (class_exists(GradoController::class)) {
    Route::resource('grados', GradoController::class);
}

if (class_exists(ProfesorController::class)) {
    Route::resource('profesores', ProfesorController::class);
}

if (class_exists(AlumnoController::class)) {
    Route::resource('alumnos', AlumnoController::class);
}

// Rutas para creación y edición de registros
Route::get('grados/create', [GradoController::class, 'create'])->name('grados.create');
Route::post('grados', [GradoController::class, 'store'])->name('grados.store');
Route::get('grados/{grado}/edit', [GradoController::class, 'edit'])->name('grados.edit');
Route::put('grados/{grado}', [GradoController::class, 'update'])->name('grados.update');

Route::get('profesores/create', [ProfesorController::class, 'create'])->name('profesores.create');
Route::post('profesores', [ProfesorController::class, 'store'])->name('profesores.store');
Route::get('profesores/{profesor}/edit', [ProfesorController::class, 'edit'])->name('profesores.edit');
Route::put('profesores/{profesor}', [ProfesorController::class, 'update'])->name('profesores.update');

Route::get('alumnos/create', [AlumnoController::class, 'create'])->name('alumnos.create');
Route::post('alumnos', [AlumnoController::class, 'store'])->name('alumnos.store');
Route::get('alumnos/{alumno}/edit', [AlumnoController::class, 'edit'])->name('alumnos.edit');
Route::put('alumnos/{alumno}', [AlumnoController::class, 'update'])->name('alumnos.update');

// Manejo de errores para rutas incorrectas
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
