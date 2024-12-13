@extends('./layout/plantilla')
@section('titulo', 'Constructora')
@section('seccion')
    <form method="post">
        <fieldset>
            <legend><b>Formulario Creación de Tarea</b></legend>

            <label {{ ($_POST) ? $utiles->colorLabel('num-fiscal-cliente', $errores) : '' }} for="num-fiscal-cliente">
                @php $utiles->contenidoLabel('num-fiscal-cliente', 'DNI/CIF Cliente *', $errores) @endphp</label><br>
            <input type="text" name="num-fiscal-cliente" id="num-fiscal-cliente" value="{{ $utiles->valorPost('num-fiscal-cliente') }}"><br><br>

            <label {{ ($_POST) ? $utiles->colorLabel('nombre', $errores) : '' }} for="nombre">
                @php $utiles->contenidoLabel('nombre', 'Nombre Cliente *', $errores) @endphp</label><br>
            <input type="text" name="nombre" id="nombre" value="{{ $utiles->valorPost('nombre') }}"><br><br>

            <label {{ ($_POST) ? $utiles->colorLabel('apell', $errores) : '' }} for="apell">
                @php $utiles->contenidoLabel('apell', 'Apellidos Cliente *', $errores) @endphp</label><br>
            <input type="text" name="apell" id="apell" value="{{ $utiles->valorPost('apell') }}"><br><br>

            <label {{ ($_POST) ? $utiles->colorLabel('tlf', $errores) : '' }} for="tlf">
                @php $utiles->contenidoLabel('tlf', 'Teléfono Cliente *', $errores) @endphp</label><br>
            <input type="text" name="tlf" id="tlf" value="{{ $utiles->valorPost('tlf') }}"><br><br>

            <label {{ ($_POST) ? $utiles->colorLabel('descripcion', $errores) : '' }} for="descripcion">
                @php $utiles->contenidoLabel('descripcion', 'Descripción de la Tarea *', $errores) @endphp</label><br>
            <textarea name="descripcion" id="descripcion">{{ $utiles->valorPost('descripcion') }}</textarea><br><br>

            <label {{ ($_POST) ? $utiles->colorLabel('email', $errores) : '' }} for="email">
                @php $utiles->contenidoLabel('email', 'E-mail Cliente *', $errores) @endphp</label><br>
            <input type="text" name="email" id="email" value="{{ $utiles->valorPost('email') }}"><br><br>

            <label for="direccion">Dirección de Realización</label><br>
            <input type="text" name="direccion" id="direccion" value="{{ $utiles->valorPost('direccion') }}"><br><br>

            <label for="poblacion">Población de Realización</label><br>
            <input type="text" name="poblacion" id="poblacion" value="{{ $utiles->valorPost('poblacion') }}"><br><br>

            <label {{ ($_POST) ? $utiles->colorLabel('codigo-post', $errores) : '' }} for="codigo-post">
                @php $utiles->contenidoLabel('codigo-post', 'Código Postal de Realización', $errores) @endphp</label><br>
            <input type="text" name="codigo-post" id="codigo-post" value="{{ $utiles->valorPost('codigo-post') }}"><br><br>

            <label for="provincia">Provincia de Realización</label><br>
            <select name="provincia" id="provincia" value="{{ $utiles->valorPost('provincia') }}">
                <option value="0" hidden>Provincia</option>
                @foreach($provincias as $provincia)
                    <option value="{{ $provincia['cod'] }}" {{ ($utiles->valorPost('provincia') == $provincia['cod']) ? 'selected' : '' }}>{{ $provincia['nombre'] }}</option>
                @endforeach
            </select><br><br>

            <label for="estado">Estado de la Tarea</label><br>
            <input type="radio" name="estado" id="estado" value="B" {{ ($utiles->valorPost('estado') == 'B') ? 'checked' : '' }}>Esperando a Ser Aprobada<br><br>
            <input type="radio" name="estado" id="estado" value="P" {{ ($utiles->valorPost('estado') == 'P') ? 'checked' : '' }}>Pendiente<br><br>
            <input type="radio" name="estado" id="estado" value="R" {{ ($utiles->valorPost('estado') == 'R') ? 'checked' : '' }}>Realizada<br><br>
            <input type="radio" name="estado" id="estado" value="C" {{ ($utiles->valorPost('estado') == 'C') ? 'checked' : '' }}>Cancelada<br><br>

            <label for="fecha-creacion">Fecha de Creación de la Tarea</label><br>
            <input type="text" name="fecha-creacion" id="fecha-creacion" value="{{ date('d-m-Y') }}" readonly><br><br>

            <label for="operario">Operario que Realiza la Tarea</label><br>
            <select name="operario" id="operario">
                <option value="0" {{ ($utiles->valorPost('operario') == '0') ? 'selected' : '' }} hidden>Operario</option>
                <option value="1" {{ ($utiles->valorPost('operario') == '1') ? 'selected' : '' }}>Jose Miguel Ramirez</option>
                <option value="2" {{ ($utiles->valorPost('operario') == '2') ? 'selected' : '' }}>Manuel Fernandez</option>
                <option value="3" {{ ($utiles->valorPost('operario') == '3') ? 'selected' : '' }}>Ana Nuñez</option>
                <option value="4" {{ ($utiles->valorPost('operario') == '4') ? 'selected' : '' }}>Juan Rodriguez</option>
            </select><br><br>

            <label {{ ($_POST) ? $utiles->colorLabel('fecha-realizacion', $errores) : '' }} for="fecha-realizacion">
                @php $utiles->contenidoLabel('fecha-realizacion', 'Fecha de Realizacion de la Tarea', $errores) @endphp</label><br>
            <input type="text" name="fecha-realizacion" id="fecha-realizacion" value="{{ $utiles->valorPost('fecha-realizacion') }}"><br><br>

            <label for="anotaciones-anteriores">Anotaciones Anteriores a la Tarea</label><br>
            <textarea name="anotaciones-anteriores" id="anotaciones-anteriores">{{ $utiles->valorPost('anotaciones-anteriores') }}</textarea><br><br>

            <label for="anotaciones-posteriores">Anotaciones Posteriores a la Tarea</label><br>
            <textarea name="anotaciones-posteriores" id="anotaciones-posteriores">{{ $utiles->valorPost('anotaciones-posteriores') }}</textarea><br><br>

            <label for="fich-resu">Fichero Resumen de las Tareas Realizadas</label><br>
            <input type="file" name="fich-resu" id="fich-resu" value="{{ $utiles->valorPost('fich-resu') }}"><br><br>

            <label for="foto">Foto de las Tareas Realizadas</label><br>
            <input type="file" name="foto" id="foto" value="{{ $utiles->valorPost('foto') }}"><br><br>

            <button type="submit">Enviar</button>
            <button type="reset">Reset</button>
        </fieldset>
    </form>
@endsection