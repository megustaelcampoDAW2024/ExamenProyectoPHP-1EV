@extends('./layout/plantilla')
@section('titulo', 'Constructora')
@section('seccion')
    <form method="post">
        <fieldset>
            <legend><b>Formulario Modificación de Tarea</b></legend>

            <label {{ ($_POST) ? $utiles->colorLabel('num-fiscal-cliente', $errores) : '' }} for="num-fiscal-cliente">
                @php $utiles->contenidoLabel('num-fiscal-cliente', 'DNI/CIF Cliente *', $errores) @endphp</label><br>
            <input type="text" name="num-fiscal-cliente" id="num-fiscal-cliente" value="{{ ($_POST) ? $utiles->valorPost('num-fiscal-cliente') : ($task['num_fiscal_cliente'] ?? '') }}"><br><br>

            <label {{ ($_POST) ? $utiles->colorLabel('nombre', $errores) : '' }} for="nombre">
                @php $utiles->contenidoLabel('nombre', 'Nombre Cliente *', $errores) @endphp</label><br>
            <input type="text" name="nombre" id="nombre" value="{{ ($_POST) ? $utiles->valorPost('nombre') : ($task['nombre'] ?? '') }}"><br><br>

            <label {{ ($_POST) ? $utiles->colorLabel('apell', $errores) : '' }} for="apell">
                @php $utiles->contenidoLabel('apell', 'Apellidos Cliente *', $errores) @endphp</label><br>
            <input type="text" name="apell" id="apell" value="{{ ($_POST) ? $utiles->valorPost('apell') : ($task['apell'] ?? '') }}"><br><br>

            <label {{ ($_POST) ? $utiles->colorLabel('tlf', $errores) : '' }} for="tlf">
                @php $utiles->contenidoLabel('tlf', 'Teléfono Cliente *', $errores) @endphp</label><br>
            <input type="text" name="tlf" id="tlf" value="{{ ($_POST) ? $utiles->valorPost('tlf') : ($task['tlf'] ?? '') }}"><br><br>

            <label {{ ($_POST) ? $utiles->colorLabel('descripcion', $errores) : '' }} for="descripcion">
                @php $utiles->contenidoLabel('descripcion', 'Descripción de la Tarea *', $errores) @endphp</label><br>
            <textarea name="descripcion" id="descripcion">{{ ($_POST) ? $utiles->valorPost('descripcion') : ($task['descripcion'] ?? '') }}</textarea><br><br>

            <label {{ ($_POST) ? $utiles->colorLabel('email', $errores) : '' }} for="email">
                @php $utiles->contenidoLabel('email', 'E-mail Cliente *', $errores) @endphp</label><br>
            <input type="text" name="email" id="email" value="{{ ($_POST) ? $utiles->valorPost('email') : ($task['email'] ?? '') }}"><br><br>

            <label for="direccion">Dirección de Realización</label><br>
            <input type="text" name="direccion" id="direccion" value="{{ ($_POST) ? $utiles->valorPost('direccion') : ($task['direccion'] ?? '') }}"><br><br>

            <label for="poblacion">Población de Realización</label><br>
            <input type="text" name="poblacion" id="poblacion" value="{{ ($_POST) ? $utiles->valorPost('poblacion') : ($task['poblacion'] ?? '') }}"><br><br>

            <label {{ ($_POST) ? $utiles->colorLabel('codigo-post', $errores) : '' }} for="codigo-post">
                @php $utiles->contenidoLabel('codigo-post', 'Código Postal de Realización', $errores) @endphp</label><br>
            <input type="text" name="codigo-post" id="codigo-post" value="{{ ($_POST) ? $utiles->valorPost('codigo-post') : ($task['codigo_post'] ?? '') }}"><br><br>

            <label for="provincia">Provincia de Realización</label><br>
            <select name="provincia" id="provincia">
                <option value="0" hidden>Provincia</option>
                @foreach($provincias as $provincia)
                    <option value="{{ $provincia['cod'] }}" {{ ($_POST) ? ($utiles->valorPost('provincia') == $provincia['cod'] ? 'selected' : '') : ($task['provincia'] == $provincia['cod'] ? 'selected' : '') }}>{{ $provincia['nombre'] }}</option>
                @endforeach
            </select><br><br>

            <label for="estado">Estado de la Tarea</label><br>
            <input type="radio" name="estado" id="estado" value="B" {{ ($_POST) ? ($utiles->valorPost('estado') == 'B' ? 'checked' : '') : ($task['estado'] == 'B' ? 'checked' : '') }}>Esperando a Ser Aprobada<br><br>
            <input type="radio" name="estado" id="estado" value="P" {{ ($_POST) ? ($utiles->valorPost('estado') == 'P' ? 'checked' : '') : ($task['estado'] == 'P' ? 'checked' : '') }}>Pendiente<br><br>
            <input type="radio" name="estado" id="estado" value="R" {{ ($_POST) ? ($utiles->valorPost('estado') == 'R' ? 'checked' : '') : ($task['estado'] == 'R' ? 'checked' : '') }}>Realizada<br><br>
            <input type="radio" name="estado" id="estado" value="C" {{ ($_POST) ? ($utiles->valorPost('estado') == 'C' ? 'checked' : '') : ($task['estado'] == 'C' ? 'checked' : '') }}>Cancelada<br><br>

            <label for="fecha-creacion">Fecha de Creación de la Tarea</label><br>
            <input type="text" name="fecha-creacion" id="fecha-creacion" value="{{ $task['fecha_creacion'] ?? date('d-m-Y') }}" readonly><br><br>

            <label for="operario">Operario que Realiza la Tarea</label><br>
            <select name="operario" id="operario">
                <option value="0" {{ ($_POST) ? ($utiles->valorPost('operario') == '0' ? 'selected' : '') : ($task['operario'] == '0' ? 'selected' : '') }} hidden>Operario</option>
                <option value="1" {{ ($_POST) ? ($utiles->valorPost('operario') == '1' ? 'selected' : '') : ($task['operario'] == '1' ? 'selected' : '') }}>Jose Miguel Ramirez</option>
                <option value="2" {{ ($_POST) ? ($utiles->valorPost('operario') == '2' ? 'selected' : '') : ($task['operario'] == '2' ? 'selected' : '') }}>Manuel Fernandez</option>
                <option value="3" {{ ($_POST) ? ($utiles->valorPost('operario') == '3' ? 'selected' : '') : ($task['operario'] == '3' ? 'selected' : '') }}>Ana Nuñez</option>
                <option value="4" {{ ($_POST) ? ($utiles->valorPost('operario') == '4' ? 'selected' : '') : ($task['operario'] == '4' ? 'selected' : '') }}>Juan Rodriguez</option>
            </select><br><br>

            <label {{ ($_POST) ? $utiles->colorLabel('fecha-realizacion', $errores) : '' }} for="fecha-realizacion">
                @php $utiles->contenidoLabel('fecha-realizacion', 'Fecha de Realizacion de la Tarea', $errores) @endphp</label><br>
            <input type="text" name="fecha-realizacion" id="fecha-realizacion" value="{{ ($_POST) ? $utiles->valorPost('fecha-realizacion') : ($task['fecha_realizacion'] ?? '') }}"><br><br>

            <label for="anotaciones-anteriores">Anotaciones Anteriores a la Tarea</label><br>
            <textarea name="anotaciones-anteriores" id="anotaciones-anteriores">{{ ($_POST) ? $utiles->valorPost('anotaciones-anteriores') : ($task['anotaciones_anteriores'] ?? '') }}</textarea><br><br>

            <label for="anotaciones-posteriores">Anotaciones Posteriores a la Tarea</label><br>
            <textarea name="anotaciones-posteriores" id="anotaciones-posteriores">{{ ($_POST) ? $utiles->valorPost('anotaciones-posteriores') : ($task['anotaciones_posteriores'] ?? '') }}</textarea><br><br>

            <label for="fich-resu">Fichero Resumen de las Tareas Realizadas</label><br>
            <input type="file" name="fich-resu" id="fich-resu" value="{{ ($_POST) ? $utiles->valorPost('fich-resu') : ($task['fich_resu'] ?? '') }}"><br><br>

            <label for="foto">Foto de las Tareas Realizadas</label><br>
            <input type="file" name="foto" id="foto" value="{{ ($_POST) ? $utiles->valorPost('foto') : ($task['foto'] ?? '') }}"><br><br>

            <button type="submit">Actualizar</button>
            <button type="reset">Reset</button>
        </fieldset>
    </form>
@endsection