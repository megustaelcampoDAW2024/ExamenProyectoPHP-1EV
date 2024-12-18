@extends('./layout/plantilla')
@section('titulo', 'Constructora')
@section('seccion')
    <h3>Listado de tareas</h3>

    {{-- FILTRADO POR CAMPOS --}}
    <form method="POST" id="filterForm" class="form-inline mb-3">
        @csrf
        <div class="form-group mr-2">
            <label for="estado-query" class="mr-2">Estado:</label>
            <select name="estado-query" id="estado-query" class="form-control">
                <option value="" {{ $filters['estado'] == '' ? 'selected' : '' }}>Todo</option>
                <option value="B" {{ $filters['estado'] == 'B' ? 'selected' : '' }}>Esperando a Ser Aprobada (B)</option>
                <option value="P" {{ $filters['estado'] == 'P' ? 'selected' : '' }}>Pendiente (P)</option>
                <option value="R" {{ $filters['estado'] == 'R' ? 'selected' : '' }}>Realizada (R)</option>
                <option value="C" {{ $filters['estado'] == 'C' ? 'selected' : '' }}>Cancelada (C)</option>
            </select>
        </div>
        <div class="form-group mr-2">
            <label for="id-query" class="mr-2">Identificador:</label>
            <input type="text" class="form-control" name="id-query" id="id-query" style="width: 45px" value="{{ $filters['id'] }}">
        </div>
        <div class="form-group mr-2">
            <select name="id-query-criterio" id="id-query-criterio" class="form-control">
                <option value="=" {{ $filters['idCriterio'] == '=' ? 'selected' : '' }}>=</option>
                <option value=">" {{ $filters['idCriterio'] == '>' ? 'selected' : '' }}>></option>
                <option value="<" {{ $filters['idCriterio'] == '<' ? 'selected' : '' }}><</option>
            </select>
        </div>
        <div class="form-group mr-2">
            <label for="fecha-creacion-query" class="mr-2">Fecha de Creación:</label>
            <input type="date" class="form-control" name="fecha-creacion-query" id="fecha-creacion-query" value="{{ $filters['fechaCreacion'] }}">
        </div>
        <div class="form-group mr-2">
            <select name="fecha-creacion-query-criterio" id="fecha-creacion-query-criterio" class="form-control">
                <option value="=" {{ $filters['fechaCreacionCriterio'] == '=' ? 'selected' : '' }}>=</option>
                <option value=">" {{ $filters['fechaCreacionCriterio'] == '>' ? 'selected' : '' }}>></option>
                <option value="<" {{ $filters['fechaCreacionCriterio'] == '<' ? 'selected' : '' }}><</option>
            </select>
        </div>
        <div class="form-group mr-2">
            <label for="fecha-realizacion-query" class="mr-2">Fecha de Realización:</label>
            <input type="date" class="form-control" name="fecha-realizacion-query" id="fecha-realizacion-query" value="{{ $filters['fechaRealizacion'] }}">
        </div>
        <div class="form-group mr-2">
            <select name="fecha-realizacion-query-criterio" id="fecha-realizacion-query-criterio" class="form-control">
                <option value="=" {{ $filters['fechaRealizacionCriterio'] == '=' ? 'selected' : '' }}>=</option>
                <option value=">" {{ $filters['fechaRealizacionCriterio'] == '>' ? 'selected' : '' }}>></option>
                <option value="<" {{ $filters['fechaRealizacionCriterio'] == '<' ? 'selected' : '' }}><</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Fecha de creación</th>
                <th>Fecha de realización</th>
                <th>Detalles</th>
                @if ($_SESSION['status'] == 'A')
                    <th>Modificar</th>
                    <th>Eliminar</th>
                @elseif ($_SESSION['status'] == 'O')
                    <th>Completar</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task['task_id'] }}</td>
                    <td>{{ $task['nombre'] }}</td>
                    <td>{{ $task['apell'] }}</td>
                    <td>{{ $task['descripcion'] }}</td>
                    <td>{{ $task['estado'] }}</td>
                    <td>{{ $task['fecha_creacion'] }}</td>
                    <td>{{ $task['fecha_realizacion'] ?? 'N/A' }}</td>
                    <td><a href="{!!miUrl("detallesTarea/{$task['task_id']}")!!}" class="btn btn-primary">
                        Detalles 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM8 3.5a4.5 4.5 0 1 1 0 9 4.5 4.5 0 0 1 0-9z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5z"/>
                        </svg>
                    </a></td>
                    @if ($_SESSION['status'] == 'A')
                        <td><a href="{!!miUrl("modificarTarea/{$task['task_id']}")!!}" class="btn btn-warning">
                            Modificar 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                        </a></td>
                        <td><a href="{!!miUrl("confirmarEliminarTarea/{$task['task_id']}")!!}" class="btn btn-danger">
                            Eliminar 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a></td>
                    @endif
                    @if ($_SESSION['status'] == 'O')
                        <td><a href="{!!miUrl("completarTarea/{$task['task_id']}")!!}" class="btn btn-success">
                            Completar 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                                <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                              </svg>
                        </a></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination" style="{{$totalPages == 0 ? "display: none" : ''}}">
        <form method="POST" id="paginationForm" class="form-inline">
            <input type="hidden" name="page" value="{{ $page }}">
            <input type="hidden" name="estado-query" value="{{ $filters['estado'] }}">
            <input type="hidden" name="id-query" value="{{ $filters['id'] }}">
            <input type="hidden" name="id-query-criterio" value="{{ $filters['idCriterio'] }}">
            <input type="hidden" name="fecha-creacion-query" value="{{ $filters['fechaCreacion'] }}">
            <input type="hidden" name="fecha-creacion-query-criterio" value="{{ $filters['fechaCreacionCriterio'] }}">
            <input type="hidden" name="fecha-realizacion-query" value="{{ $filters['fechaRealizacion'] }}">
            <input type="hidden" name="fecha-realizacion-query-criterio" value="{{ $filters['fechaRealizacionCriterio'] }}">
    
            <button type="submit" name="page" value="1" class="btn btn-link" style="{{ $page == 1 ? 'pointer-events: none; color: gray;' : '' }}">Primera</button> | 
            <button type="submit" name="page" value="{{ $page - 1 }}" class="btn btn-link" style="{{ $page == 1 ? 'pointer-events: none; color: gray;' : '' }}">Anterior</button> | 
            <span>&nbsp; Página {{ $page }} de {{ $totalPages }} &nbsp;</span>| 
            <button type="submit" name="page" value="{{ $page + 1 }}" class="btn btn-link" style="{{ $page == $totalPages ? 'pointer-events: none; color: gray;' : '' }}">Siguiente</button> | 
            <button type="submit" name="page" value="{{ $totalPages }}" class="btn btn-link" style="{{ $page == $totalPages ? 'pointer-events: none; color: gray;' : '' }}">Última</button>
        </form>
    </div>
@endsection