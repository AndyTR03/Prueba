@extends ('layouts.admin')

@section ('contenido')
<?php
echo date_default_timezone_get();
?>

    <h1>Listado de Alertas</h1>
    
    <form action="{{ route('alertas.index') }}" method="GET">
        <input type="text" name="search" value="{{ request()->input('search') }}" placeholder="Buscar alertas...">
        <button type="submit">Buscar</button>
    </form>
   
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearAlertaModal">
        Crear Alerta
    </button>

    @if(session('success'))
        <div id="success-message" class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mensaje</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="alertasTableBody">
                @foreach ($alertas as $alerta)
                    <tr data-id="{{ $alerta->id }}">
                        <td>{{ $alerta->id }}</td>
                        <td>{{ $alerta->mensaje }}</td>
                        <td>{{ $alerta->fecha_creacion }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModalAlerta" data-id="{{ $alerta->id }}">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger" onclick="deleteAlerta({{ $alerta->id }})">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('alertas.create') <!-- Modal para crear alertas -->
    @include('alertas.delete') <!-- Modal para eliminar alertas -->
    @include('alertas.edit') <!-- Modal para editar alertas -->
    <div>
    {{ $alertas->links('vendor.pagination.bootstrap-5') }}
    </div>
    <script src="{{ asset('js/alertas.js') }}"></script>
@stop
