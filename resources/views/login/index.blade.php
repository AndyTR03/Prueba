@extends('layouts.admin')

@section('contenido')
<h1>logins</h1>

<!-- Buscador -->
<form action="{{ route('logins.index') }}" method="GET">
    <input type="text" name="search" value="{{ $search }}" placeholder="Buscar...">
    <button type="submit">Buscar</button>
</form>

<!-- Botón para abrir el modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearLoginModal">Crear Login</button>


<br>
@if(session('success'))
    <div id="success-message" class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logins as $login)
                <tr data-id="{{ $login->id }}">
                    <td>{{ $login->usuario_id }}</td>
                    <td>{{ $login->username }}</td>
                    <td>{{ $login->password }}</td>
                    <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
                            Editar
                        </button>
                        <button type="button" class="btn btn-danger" onclick="deleteLogin({{ $login->id }})">
                            Eliminar
                        </button>
                        @include('login.delete', ['login' => $login])
                        @include('login.edit', ['login' => $login])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('login.create') <!-- Modal para crear login -->

<script src="{{ asset('js/logins.js') }}"></script>
@stop
