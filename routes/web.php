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
use App\Http\Controllers\ApiConfigController;
use App\Http\Controllers\FileSendConfigController;

// Ruta para mostrar el formulario de configuración
Route::get('/file-send', [FileSendConfigController::class, 'showForm'])->name('file.send.config');

// Ruta para manejar el envío del formulario
Route::post('/file-send', [FileSendConfigController::class, 'handleRequest'])->name('file.send.config.handle');

// Mostrar el formulario y manejar las solicitudes
Route::match(['get', 'post'], '/api_config', [ApiConfigController::class, 'handleRequest'])->name('api.config');

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

