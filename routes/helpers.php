<?php
/**
 * Genera una URL completa para el proyecto.
 *
 * @param string $url La URL relativa.
 * @return string La URL completa.
 */
function miUrl(String $url){
    return "http://localhost/ExamenProyectoPHP-1EV/public/" . $url;
}

/**
 * Redirige a una URL específica.
 *
 * @param string $url La URL relativa.
 */
function myRedirect($url){
    header('Location: http://localhost/ExamenProyectoPHP-1EV/public/' . $url);
    exit();
}
?>