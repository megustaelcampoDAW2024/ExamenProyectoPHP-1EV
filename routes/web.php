<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tareas;

include 'helpers.php';

Route::any('/', [Tareas::class, 'logIn']);
Route::any('logIn', [Tareas::class, 'logIn']);
Route::any('inicio', [Tareas::class, 'inicio']);
Route::any('listarTareas', [Tareas::class, 'listarTareas']);
Route::any('listarTareas/uncompleted', [Tareas::class, 'listarTareasPorCompletar']);
Route::any('crearTarea', [Tareas::class, 'crearTarea']);
Route::any('logOut', [Tareas::class, 'logOut']);

Route::any('detallesTarea/{id}', [Tareas::class, 'detallesTarea'])->where('id', '[0-9]+');
Route::any('modificarTarea/{id}', [Tareas::class, 'modificarTarea'])->where('id', '[0-9]+');
Route::any('completarTarea/{id}', [Tareas::class, 'completarTarea'])->where('id', '[0-9]+');
Route::any('eliminarTarea/{id}', [Tareas::class, 'eliminarTarea'])->where('id', '[0-9]+');
Route::any('confirmarEliminarTarea/{id}', [Tareas::class, 'confirmarEliminarTarea'])->where('id', '[0-9]+');

Route::any('eliminarFichResu/{id}', [Tareas::class, 'eliminarFichResu'])->where('id', '[0-9]+');
Route::any('eliminarFoto/{id}', [Tareas::class, 'eliminarFoto'])->where('id', '[0-9]+');

Route::any('administrarUsuarios', [Tareas::class, 'administrarUsuarios']);
Route::any('crearUsuario', [Tareas::class, 'crearUsuario']);
Route::any('editarUsuario/{id}', [Tareas::class, 'editarUsuario'])->where('id', '[0-9]+');
Route::any('eliminarUsuario/{id}', [Tareas::class, 'eliminarUsuario'])->where('id', '[0-9]+');