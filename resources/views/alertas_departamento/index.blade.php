@extends('layouts.admin')

@section('contenido')
    <h1>Listado de Alertas por Departamento</h1>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Alerta ID</th>
                    <th>Departamento ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alertasDepartamentos as $alertaDepartamento)
                    <tr>
                        <td>{{ $alertaDepartamento->id }}</td>
                        <td>{{ $alertaDepartamento->alerta_id }}</td>
                        <td>{{ $alertaDepartamento->departamento_id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
