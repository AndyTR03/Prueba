@extends('layouts.admin')

@section('contenido')
    <h1>Listado de Usuarios por Departamento</h1>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario ID</th>
                    <th>Departamento ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuariosDepartamentos as $usuarioDepartamento)
                    <tr>
                        <td>{{ $usuarioDepartamento->id }}</td>
                        <td>{{ $usuarioDepartamento->usuario_id }}</td>
                        <td>{{ $usuarioDepartamento->departamento_id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
