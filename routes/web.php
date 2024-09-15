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

Route::resource('alertas', AlertaController::class);
Route::resource('alertas_departamento', AlertaDepartamentoController::class);
Route::resource('alertas_usuario', AlertaUsuarioController::class);
Route::resource('departamentos', DepartamentoController::class);
Route::resource('logins', LoginController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('usuarios_departamento', UsuarioDepartamentoController::class);
