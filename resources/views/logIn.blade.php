<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <title>Document</title>
    </head>
    <body class="container mt-5">
        <form method="POST" class="border p-4 bg-light">
            @if(!$logError)
                <h3>Log In</h3>
            @else
                <h3 class="text-danger">Usuario o Contraseña Incorrectos</h3>
            @endif
            <div class="form-group">
                <label for="user">Usuario</label>
                <input type="text" class="form-control" name="user" id="user" value="{{ $utiles->valorPost('user') !== '' ? $utiles->valorPost('user') : (isset($_COOKIE['usuario']) ? $_COOKIE['usuario'] : '') }}">
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input type="password" class="form-control" name="pass" id="pass" value="{{ $utiles->valorPost('pass') !== '' ? $utiles->valorPost('pass') : (isset($_COOKIE['password']) ? $_COOKIE['password'] : '') }}">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ $utiles->valorPost('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Recordar Usuario</label>
            </div>
            <button type="submit" class="btn btn-primary">Log In</button>
        </form>
    </body>
</html>