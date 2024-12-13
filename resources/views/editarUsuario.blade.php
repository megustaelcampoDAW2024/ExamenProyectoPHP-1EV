@extends('Layout.plantilla')
@section('titulo', 'Constructora')
@section('seccion')
    <h3>Editar Usuario</h3>
    <form method="post" class="form-group">
        <fieldset>
            <legend>Información del Usuario</legend>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" value="{{ $usuario->usuario }}" required class="form-control"><br>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required class="form-control"><br>
            <label for="status">Status:</label>
            <select name="status" class="form-control">
                <option value="A" {{ $usuario->status == 'A' ? 'selected' : '' }}>Administrador</option>
                <option value="O" {{ $usuario->status == 'O' ? 'selected' : '' }}>Operario</option>
            </select><br>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </fieldset>
    </form>
@endsection