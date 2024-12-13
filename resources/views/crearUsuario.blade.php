@extends('Layout.plantilla')
@section('titulo', 'Constructora')
@section('seccion')
    <h3>Crear Usuario</h3>
    <form method="post" class="form-group">
        <fieldset>
            <legend>Información del Usuario</legend>
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" required class="form-control"><br>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required class="form-control"><br>
            <label for="status">Status:</label>
            <select name="status" class="form-control">
                <option value="A">Administrador</option>
                <option value="O">Operario</option>
            </select><br>
            <button type="submit" class="btn btn-primary">Crear</button>
        </fieldset>
    </form>
@endsection