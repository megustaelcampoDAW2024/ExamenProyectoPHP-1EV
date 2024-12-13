@extends('./layout/plantilla')
@section('titulo', 'Constructora')
@section('seccion')
    <div class="container mt-4">
        <h3>¿Desea Eliminar la Tarea?</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="bg-danger text-white"><a href="{!!miUrl("eliminarTarea/{$id}")!!}" class="text-white">Eliminar Tarea</a></th>
                    <th class="bg-success text-white"><a href="{!!miUrl("detallesTarea/{$id}")!!}" class="text-white">Cancelar</a></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Id tarea</td>
                    <td>{{$task['task_id']}}</td>
                </tr>    
                <tr>
                    <td>NIF Cliente</td>
                    <td>{{$task['num_fiscal_cliente']}}</td>
                </tr>    
                <tr>
                    <td>Nombre</td>
                    <td>{{$task['nombre']}}</td>
                </tr>    
                <tr>
                    <td>Apellidos</td>
                    <td>{{$task['apell']}}</td>
                </tr>    
                <tr>
                    <td>Teléfono</td>
                    <td>{{$task['tlf']}}</td>
                </tr>    
                <tr>
                    <td>Descripción</td>
                    <td>{{$task['descripcion']}}</td>
                </tr>    
                <tr>
                    <td>Email</td>
                    <td>{{$task['email']}}</td>
                </tr>    
                <tr>
                    <td>Dirección</td>
                    <td>{{$task['direccion']}}</td>
                </tr>    
                <tr>
                    <td>Población</td>
                    <td>{{$task['poblacion']}}</td>
                </tr>    
                <tr>
                    <td>Código Postal</td>
                    <td>{{$task['codigo_post']}}</td>
                </tr>    
                <tr>
                    <td>Provincia</td>
                    <td>{{$provincia}}</td>
                </tr>   
                <tr>
                    <td>Estado</td>
                    <td>{{$task['estado']}}</td>
                </tr>    
                <tr>
                    <td>Operario</td>
                    <td>{{$operario['usuario']}}</td>
                </tr>
                <tr>
                    <td>Fecha Creación</td>
                    <td>{{$task['fecha_creacion']}}</td>
                </tr>    
                <tr>
                    <td>Fecha Realización</td>
                    <td>{{$task['fecha_realizacion']}}</td>
                </tr>    
                <tr>
                    <td>Anotaciones Anteriores</td>
                    <td>{{$task['anotaciones_anteriores']}}</td>
                </tr>    
                <tr>
                    <td>Anotaciones Posteriores</td>
                    <td>{{$task['anotaciones_posteriores']}}</td>
                </tr>    
                <tr>
                    <td>Fichero Resumen</td>
                    <td>
                        @if($task['fich_resu'])
                            <p>Nombre Archivo:<br> {{$task['fich_resu']}}</p>
                            <a href="{!!'../../storage/app/public/'.$task['fich_resu']!!}" target="_blank" class="btn btn-info">CONSULTAR</a>
                            <a href="{!!'../../storage/app/public/'.$task['fich_resu']!!}" download class="btn btn-success">DESCARGAR</a><br>
                            <embed src="{!!'../../storage/app/public/'.$task['fich_resu']!!}" width="440px" height="600px">
                        @endif
                    </td>
                </tr>    
                <tr>
                    <td>Foto</td>
                    <td>
                        @if($task['foto'])
                            <p>Nombre Archivo:<br> {{$task['foto']}}</p>
                            <a href="{!!'../../storage/app/public/'.$task['foto']!!}" target="_blank" class="btn btn-info">CONSULTAR</a>
                            <a href="{!!'../../storage/app/public/'.$task['foto']!!}" download class="btn btn-success">DESCARGAR</a><br>
                            <img src="{!!'../../storage/app/public/'.$task['foto']!!}" alt="Foto" width="400px">
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection