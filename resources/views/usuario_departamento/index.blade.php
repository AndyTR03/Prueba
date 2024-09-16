@extends('layouts.admin')

@section('contenido')
    <h1>Listado de Usuarios por Departamento</h1>
    
    <form action="{{ route('usuarios_departamento.index') }}" method="GET" class="mb-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por usuario o departamento..." class="form-control" style="width: auto; display: inline-block;">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearUsuarioDepartamentoModal">
        Crear Usuario
    </button>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Departamento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuariosDepartamentos as $usuarioDepartamento)
                    <tr data-id="{{ $usuarioDepartamento->id }}">
                        <td>{{ $usuarioDepartamento->id }}</td>
                        <td>{{ $usuarioDepartamento->usuario->nombre }} {{ $usuarioDepartamento->usuario->apellido }}</td>
                        <td>{{ $usuarioDepartamento->departamento->nombre }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-id="{{ $usuarioDepartamento->id }}">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger" onclick="deleteUsuarioDepartamento({{ $usuarioDepartamento->id }})">
                                Eliminar
                            </button>
                            
                            <!-- Modal de confirmación de eliminación -->
                            @include('usuario_departamento.delete', ['usuarioDepartamento' => $usuarioDepartamento])
                            <!-- Modal para editar usuario departamento -->
                            @include('usuario_departamento.edit', ['usuarioDepartamento' => $usuarioDepartamento])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
<div class="pagination-wrapper" id="paginationLinks">
    {{ $usuariosDepartamentos->links() }}
</div>


    @include('usuario_departamento.create')
    <script src="{{ asset('js/usuariodepartamento.js') }}"></script>
@stop