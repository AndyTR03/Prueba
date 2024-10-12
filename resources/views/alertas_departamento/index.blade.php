@extends('layouts.admin')

@section('contenido')
    <h1>Listado de Alertas por Departamento</h1>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mensaje</th>
                    <th>Nombre del Departamento</th>
                </tr>
            </thead>
            <tbody>
    @foreach ($alertasDepartamentos as $alertaDepartamento)
        <tr>
            <td>{{ $alertaDepartamento->id }}</td>
            <td>
                @if ($alertaDepartamento->alerta)
                    {{ $alertaDepartamento->alerta->mensaje }}
                @else
                    <span class="text-muted">No mensaje available</span>
                @endif
            </td>
            <td>
                @if ($alertaDepartamento->departamento)
                    {{ $alertaDepartamento->departamento->nombre }}
                @else
                    <span class="text-muted">No departamento available</span>
                @endif
            </td>
        </tr>
    @endforeach
</tbody>

        </table>
    </div>
@stop
