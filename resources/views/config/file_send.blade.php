@extends('layouts.admin')

@section('contenido')
<div class="container mt-5">
    <h2>Configuración de Envío de Archivos PDF</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Formulario para guardar la configuración -->
    <form action="{{ route('file.send.config.handle') }}" method="POST">
        @csrf
        <input type="hidden" name="action" value="save">
        <div class="form-group">
            <label for="token">Token:</label>
            <input type="text" class="form-control" id="token" name="token" value="{{ $config['token'] ?? '' }}" required>
        </div>
        <div class="form-group">
            <label for="url">URL:</label>
            <input type="url" class="form-control" id="url" name="url" value="{{ $config['url'] ?? '' }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Configuración</button>
    </form>

    <!-- Formulario para restaurar los valores predeterminados -->
    <form action="{{ route('file.send.config.handle') }}" method="POST" class="mt-3">
        @csrf
        <input type="hidden" name="action" value="restore">
        <button type="submit" class="btn btn-warning">Restaurar Valores Predeterminados</button>
    </form>
</div>
@endsection
