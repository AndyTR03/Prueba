@extends ('layouts.admin')

@section ('contenido')
    <h1>Listado de Alertas</h1>
    
    <!-- Buscador para Alertas -->
    <form action="{{ route('alertas.index') }}" method="GET">
        <input type="text" name="search" value="{{ request()->input('search') }}" placeholder="Buscar alertas...">
        <button type="submit">Buscar</button>
    </form>
   
    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearAlertaModal">
        Crear Alerta
    </button>

    <!-- Mensaje de éxito tras una acción exitosa -->
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
                    <th>Acciones</th> <!-- Agregamos una columna para las acciones -->
                </tr>
            </thead>
            <tbody>
                @foreach ($alertas as $alerta)
                    <tr data-id="{{ $alerta->id }}">
                        <td>{{ $alerta->id }}</td>
                        <td>{{ $alerta->mensaje }}</td>
                        <td>{{ $alerta->fecha_creacion }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModalAlerta{{ $alerta->id }}">
                                Editar
                            </button>
                            <button type="button" class="btn btn-danger" onclick="deleteAlerta({{ $alerta->id }})">
                                Eliminar
                            </button>
                            @include('alertas.delete', ['alertas' => $alerta])
                            @include('alertas.edit', ['alertas' => $alerta])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('alertas.create')

<script src="{{ asset('js/alertas.js') }}"></script>

@stop
