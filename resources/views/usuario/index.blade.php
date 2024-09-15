@extends('layouts.admin')

@section('contenido')
<h1>Usuarios</h1>

<!-- Buscador -->
<form action="{{ route('usuarios.index') }}" method="GET">
    <input type="text" name="search" value="{{ $search }}" placeholder="Buscar...">
    <button type="submit">Buscar</button>
</form>

<!-- Botón para abrir el modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearUsuarioModal">
    Crear Usuario
</button>

<br>
@if(session('success'))
    <div id="success-message" class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr data-id="{{ $usuario->id }}">
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->apellido }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->telefono }}</td>
                    <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
                            Editar
                        </button>
                        <button type="button" class="btn btn-danger" onclick="deleteUser({{ $usuario->id }})">
                            Eliminar
                        </button>
                        @include('usuario.delete', ['usuario' => $usuario])
                        @include('usuario.edit', ['usuario' => $usuario])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('usuario.create') <!-- Modal para crear usuario -->

<script src="{{ asset('js/usuarios.js') }}"></script>
@stop
