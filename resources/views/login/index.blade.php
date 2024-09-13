@extends('layouts.admin')

@section('contenido')
    <h1>Listado de Logins</h1>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario ID</th>
                    <th>Username</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logins as $login)
                    <tr>
                        <td>{{ $login->id }}</td>
                        <td>{{ $login->usuario_id }}</td>
                        <td>{{ $login->username }}</td>
                        <td>{{ $login->password }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
