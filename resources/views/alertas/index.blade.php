@extends ('layouts.admin')

@section ('contenido')
    <h1>Listado de Alertas</h1>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mensaje</th>
                    <th>Fecha de Creación</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alertas as $alerta)
                    <tr>
                        <td>{{ $alerta->id }}</td>
                        <td>{{ $alerta->mensaje }}</td>
                        <td>{{ $alerta->fecha_creacion }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
