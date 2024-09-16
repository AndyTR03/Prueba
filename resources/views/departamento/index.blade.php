@extends('layouts.admin')

@section('contenido')
<h1>Departamentos</h1>

<!-- Buscador -->
<form action="{{ route('departamentos.index') }}" method="GET">
    <input type="text" name="search" value="{{ $search }}" placeholder="Buscar...">
    <button type="submit">Buscar</button>
</form>

<!-- Botón para abrir el modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearDepartamentoModal">
    Crear Departamento
</button>

<br>
@if(session('success'))
    <div id="success-message" class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($departamentos as $departamento)
                <tr data-id="{{ $departamento->id }}">
                    <td>{{ $departamento->id }}</td>
                    <td>{{ $departamento->nombre }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModalDepartamento{{ $departamento->id }}">
                            Editar
                        </button>
                        <button type="button" class="btn btn-danger" onclick="deleteDepartamento({{ $departamento->id }})">
                            Eliminar
                        </button>
                        @include('departamento.delete', ['departamento' => $departamento])
                        @include('departamento.edit', ['departamento' => $departamento])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('departamento.create') <!-- Modal para crear departamento -->

<script src="{{ asset('js/departamentos.js') }}"></script>
@stop
