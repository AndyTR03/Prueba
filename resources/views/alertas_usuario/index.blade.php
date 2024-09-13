@extends('layouts.admin')

@section('contenido')
    <h1>Listado de Alertas por Usuario</h1>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Alerta ID</th>
                    <th>Usuario ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alertasUsuarios as $alertaUsuario)
                    <tr>
                        <td>{{ $alertaUsuario->id }}</td>
                        <td>{{ $alertaUsuario->alerta_id }}</td>
                        <td>{{ $alertaUsuario->usuario_id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
