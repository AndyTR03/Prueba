<?php

use App\Http\Controllers\AlertaController;
use App\Http\Controllers\AlertaDepartamentoController;
use App\Http\Controllers\AlertaUsuarioController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UsuarioDepartamentoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/alertas', [AlertaController::class, 'index']);
Route::get('/alertas_departamento', [AlertaDepartamentoController::class, 'index']);
Route::get('/alertas_usuario', [AlertaUsuarioController::class, 'index']);
Route::get('/departamentos', [DepartamentoController::class, 'index']);
Route::get('/logins', [LoginController::class, 'index']);
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::get('/usuarios_departamento', [UsuarioDepartamentoController::class, 'index']);