@extends('layouts.admin')

@section('contenido')
    <h1>Listado de Departamentos</h1>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departamentos as $departamento)
                    <tr>
                        <td>{{ $departamento->id }}</td>
                        <td>{{ $departamento->nombre }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
