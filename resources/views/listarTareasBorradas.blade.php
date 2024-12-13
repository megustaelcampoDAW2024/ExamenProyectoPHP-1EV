@extends('./layout/plantilla')
@section('titulo', 'Tareas Borradas')
@section('seccion')
    <div class="container mt-4">
        <h1 class="text-center">Tareas Borradas</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr style="background-color: lightcoral;">
                    <td>{{ $task['task_id'] }}</td>
                    <td>{{ $task['nombre'] }}</td>
                    <td>{{ $task['apell'] }}</td>
                    <td>{{ $task['descripcion'] }}</td>
                    <td>{{ $task['estado'] }}</td>
                    <td>{{ $task['fecha_creacion'] }}</td>
                    <td>
                        <form action="{{ url('recuperarTarea/' . $task['task_id']) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-success">Recuperar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection