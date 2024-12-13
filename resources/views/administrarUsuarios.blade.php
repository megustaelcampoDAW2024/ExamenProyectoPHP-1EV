@extends('Layout.plantilla')
@section('titulo', 'Constructora')
@section('seccion')
    <h3>Administrar Usuarios</h3>
    <a href="{{ miUrl('crearUsuario') }}" class="btn btn-primary">Añadir Usuario</a><br><br>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Status</th>
            <th>Editar Usuario</th>
            <th>Eliminar Usuario</th>
        </tr>
        @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->usuario }}</td>
                <td>
                    @if($usuario->status == 'A')
                        Administrador
                    @elseif($usuario->status == 'O')
                        Operario
                    @else
                        Desconocido
                    @endif
                </td>
                <td>
                    <a href="{{ miUrl('editarUsuario/'.$usuario->id) }}" class="btn btn-warning">Editar</a>
                </td>
                <td>
                    <a href="{{ miUrl('eliminarUsuario/'.$usuario->id) }}" class="btn btn-danger">Eliminar</a>
                </td>
            </tr>
        @endforeach
    </table><br>
@endsection