<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <header class="bg-light p-3">
            <p class="text-right">Usuario: {{$_SESSION['usuario']}} | @if($_SESSION['status'] == 'A') Administrador @else Operario @endif | <a href="{{miUrl('logOut')}}" class="btn btn-danger btn-sm">Log Out</a></p>
            <h1 class="text-center">@yield('titulo')</h1>
        </header>
        <div class="d-flex">
            <nav class="navbar navbar-light bg-light flex-column p-3" style="width: 250px;">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="<?=miUrl('inicio')?>">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?=miUrl('listarTareas')?>">Listar Tareas</a></li>
                    @if ($_SESSION['status'] == 'A')
                        <li class="nav-item"><a class="nav-link" href="<?=miUrl('crearTarea')?>">Crear Tarea</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?=miUrl('administrarUsuarios')?>">Administrar Usuarios</a></li>
                    @endif
                </ul>
            </nav>
            <div class="container-fluid mt-4">
                @yield('seccion')
            </div>
        </div>
        <footer class="bg-light text-center p-3 mt-4">
            <p>Derechos reservados por megustaelcampo. Registrado &copy; {{ date('Y') }}</p>
        </footer>
    </body>
</html>