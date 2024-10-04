<?php

use App\Http\Controllers\AlertaController;
use App\Http\Controllers\AlertaDepartamentoController;
use App\Http\Controllers\AlertaUsuarioController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UsuarioDepartamentoController;
use App\Http\Controllers\WhatsAppController; // Importar el controlador de WhatsApp
use Illuminate\Support\Facades\Route;

// Ruta para la página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas de recursos
Route::resource('alertas', AlertaController::class);
Route::resource('alertas_departamento', AlertaDepartamentoController::class);
Route::resource('alertas_usuario', AlertaUsuarioController::class);
Route::resource('departamentos', DepartamentoController::class);
Route::resource('logins', LoginController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('usuarios_departamento', UsuarioDepartamentoController::class);

// Ruta para mostrar el formulario de enviar mensaje
Route::get('/send-message', function () {
    return view('sendMessage'); // Asegúrate de que esta vista existe
})->name('send.message.form');

// Ruta para manejar el envío del mensaje
Route::post('/send-message', [WhatsAppController::class, 'sendMessage'])->name('send.message');
