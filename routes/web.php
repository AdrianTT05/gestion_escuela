<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\alumnosController;
use App\Http\Controllers\Web\profesorController;
use App\Http\Controllers\Web\cursoController;
use App\Http\Controllers\Web\modulosController;
use App\Http\Controllers\Web\informeController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('profesores')->group(function () {
    Route::get('/', [profesorController::class, 'index']);
    Route::get('/create', [profesorController::class, 'create']);
    Route::post('/', [profesorController::class, 'store']);
    Route::get('/created', fn () => view('profesor.profesor_created'));
    Route::get('/updated', fn () => view('profesor.profesor_updated'));
    Route::get('/deleted', fn () => view('profesor.profesor_deleted'));
    Route::get('/{id}', [profesorController::class, 'show']);
    Route::get('/{id}/edit', [profesorController::class, 'edit']);
    Route::put('/{id}', [profesorController::class, 'update']);
    Route::delete('/{id}', [profesorController::class, 'destroy']);
});

Route::get('/alumnos', [alumnosController::class, 'index']);

Route::get('/cursos', [cursoController::class, 'index']);

Route::prefix('modulos')->group(function () {
    Route::get('/', [modulosController::class, 'index']);
    Route::get('/create', [modulosController::class, 'create']);
    Route::post('/', [modulosController::class, 'store']);
    Route::get('/created', fn () => view('modulos.modulos_created'));
    Route::get('/updated', fn () => view('modulos.modulos_updated'));
    Route::get('/deleted', fn () => view('modulos.modulos_deleted'));
    Route::get('/{id}/edit', [modulosController::class, 'edit']);
    Route::put('/{id}', [modulosController::class, 'update']);
    Route::delete('/{id}', [modulosController::class, 'destroy']);
});

Route::get('/informe', [informeController::class, 'index']);
Route::get('/informe/profesor/{id}', [informeController::class, 'profesor']);
