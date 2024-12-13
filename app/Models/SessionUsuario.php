<?php

namespace App\Models;

/**
 * Clase para gestionar la sesión del usuario.
 */
class SessionUsuario
{
    /**
     * Constructor. Inicia la sesión si no está iniciada.
     */
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Inicia sesión con el usuario, contraseña y estado proporcionados.
     *
     * @param string $usuario Nombre de usuario.
     * @param string $password Contraseña del usuario.
     * @param string $status Estado del usuario.
     */
    public function login($usuario, $password, $status)
    {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['password'] = $password;
        $_SESSION['status'] = $status;
    }

    /**
     * Establece un valor en la sesión.
     *
     * @param string $key Clave del valor a establecer.
     * @param mixed $value Valor a establecer.
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Obtiene un valor de la sesión.
     *
     * @param string $key Clave del valor a obtener.
     * @return mixed|null Valor almacenado en la sesión o null si no existe.
     */
    public function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * Elimina un valor de la sesión.
     *
     * @param string $key Clave del valor a eliminar.
     */
    public function delete($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Destruye la sesión.
     */
    public function destroy()
    {
        session_unset();
        session_destroy();
    }

    /**
     * Verifica si el usuario está logueado.
     *
     * @return bool True si el usuario está logueado, false en caso contrario.
     */
    public function isLogged()
    {
        if (!isset($_SESSION['usuario']) || !isset($_SESSION['password']) || !isset($_SESSION['status'])) {
            return false;
        } else {
            return true;
        }
    }
}
?>