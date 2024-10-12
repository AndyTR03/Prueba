@extends('layouts.admin')

@section('contenido')
    <h1>Listado de Alertas por Usuario</h1>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mensaje de Alerta</th>
                    <th>Nombre del Usuario</th>
                    <th>Apellido del Usuario</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alertasUsuarios as $alertaUsuario)
                    <tr>
                        <td>{{ $alertaUsuario->id }}</td>
                        <td>
                            @if ($alertaUsuario->alerta)
                                {{ $alertaUsuario->alerta->mensaje }}
                            @else
                                <span class="text-muted">No mensaje disponible</span>
                            @endif
                        </td>
                        <td>
                            @if ($alertaUsuario->usuario)
                                {{ $alertaUsuario->usuario->nombre }}
                            @else
                                <span class="text-muted">No nombre disponible</span>
                            @endif
                        </td>
                        <td>
                            @if ($alertaUsuario->usuario)
                                {{ $alertaUsuario->usuario->apellido }}
                            @else
                                <span class="text-muted">No apellido disponible</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
