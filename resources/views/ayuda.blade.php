@extends('./layout/plantilla')
@section('titulo', 'Constructora')
@section('seccion')
    <body>
        <div class="container mt-5">
            <h1 class="mb-4">Ayuda</h1>
            <p>Bienvenido a la página de ayuda. Aquí encontrarás información sobre cómo utilizar la aplicación.</p>
            
            <h2 class="mt-4">Iniciar Sesión</h2>
            <p>Para iniciar sesión, ve a la página de <a href="{{ url('logIn') }}">Inicio de Sesión</a> e ingresa tus credenciales.</p>
            
            <h2 class="mt-4">Listar Tareas</h2>
            <p>Para ver la lista de tareas, ve a la página de <a href="{{ url('listarTareas') }}">Listar Tareas</a>. Aquí podrás ver todas las tareas disponibles.</p>
            
            <h2 class="mt-4">Crear Tarea</h2>
            <p>Para crear una nueva tarea, ve a la página de <a href="{{ url('crearTarea') }}">Crear Tarea</a> y completa el formulario.</p>
            
            <h2 class="mt-4">Administrar Usuarios</h2>
            <p>Para administrar usuarios, ve a la página de <a href="{{ url('administrarUsuarios') }}">Administrar Usuarios</a>. Aquí podrás crear, editar y eliminar usuarios.</p>
            
            <h2 class="mt-4">Contacto</h2>
            <p>Si necesitas más ayuda, por favor contacta con el soporte técnico a través del correo electrónico soporte@ejemplo.com.</p>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
@endsection