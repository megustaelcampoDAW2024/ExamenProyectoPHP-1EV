<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SingletonDB;
use PDO;

class dbModel extends Model
{
    /**
     * Obtiene las tareas ordenadas por fecha de creación en orden descendente.
     *
     * @return array Arreglo de tareas.
     */
    public static function getTasksOrderedByDate()
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "SELECT task_id, nombre, apell, descripcion, estado, fecha_creacion
        FROM task 
        ORDER BY fecha_creacion DESC";
        $result = $db->conn->query($sql);
        $tasks = [];
        while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
            $row['fecha_creacion'] = date('d-m-Y', strtotime($row['fecha_creacion']));
            $tasks[] = $row;
        }
        return $tasks;
    }

    /**
     * Obtiene las tareas paginadas.
     *
     * @param int $limit Número máximo de tareas a obtener.
     * @param int $offset Desplazamiento para la paginación.
     * @return array Arreglo de tareas.
     */
    public static function getTasksByPage($limit, $offset)
    {
        $db = SingletonDB::getInstance();
        $stmt = $db->conn->prepare('SELECT task_id, nombre, apell, descripcion, estado, fecha_creacion, fecha_realizacion 
        FROM task 
        ORDER BY fecha_creacion 
        DESC LIMIT :limit OFFSET :offset');
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($tasks as &$task) {
            $task['fecha_creacion'] = date('d-m-Y', strtotime($task['fecha_creacion']));
            if($task['fecha_realizacion'] != null){
                $task['fecha_realizacion'] = date('d-m-Y', strtotime($task['fecha_realizacion']));
            }
        }
        return $tasks;
    }

    /**
     * Cuenta el número total de tareas.
     *
     * @return int Número total de tareas.
     */
    public static function countTasks()
    {
        $db = SingletonDB::getInstance();
        $stmt = $db->conn->query('SELECT COUNT(*) FROM task');
        return $stmt->fetchColumn();
    }

    /**
     * Obtiene una tarea por su ID.
     *
     * @param int $id ID de la tarea.
     * @return array|null Tarea encontrada o null si no existe.
     */
    public static function getTaskById($id)
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "SELECT task_id, num_fiscal_cliente, nombre, apell, tlf, descripcion, email, direccion, poblacion, 
        codigo_post, provincia, estado, fecha_creacion, operario_id, fecha_realizacion, anotaciones_anteriores, 
        anotaciones_posteriores, fich_resu, foto
        FROM task 
        WHERE task_id = $id";
        $result = $db->conn->query($sql);
        $task = $result->fetch(\PDO::FETCH_ASSOC);
        if ($task) {
            if($task['fecha_creacion'] != null) {
                $task['fecha_creacion'] = date('d-m-Y', strtotime($task['fecha_creacion']));
            }
            if($task['fecha_realizacion'] != null) {
                $task['fecha_realizacion'] = date('d-m-Y', strtotime($task['fecha_realizacion']));
            }
        }
        return $task;
    }

    /**
     * Cuenta el número de tareas que cumplen con los filtros especificados.
     *
     * @param array $filters Filtros a aplicar.
     * @return int Número de tareas que cumplen con los filtros.
     */
    public static function countFilteredTasks($filters)
    {
        $db = SingletonDB::getInstance();
        $sql = "SELECT COUNT(*) FROM task WHERE 1=1";
    
        if ($filters['estado']) {
            $sql .= " AND estado = '{$filters['estado']}'";
        }
        if ($filters['id']) {
            $sql .= " AND task_id {$filters['idCriterio']} {$filters['id']}";
        }
        if ($filters['fechaCreacion']) {
            $sql .= " AND fecha_creacion {$filters['fechaCreacionCriterio']} '{$filters['fechaCreacion']}'";
        }
        if ($filters['fechaRealizacion']) {
            $sql .= " AND fecha_realizacion {$filters['fechaRealizacionCriterio']} '{$filters['fechaRealizacion']}'";
        }
    
        $stmt = $db->conn->query($sql);
        return $stmt->fetchColumn();
    }
    
    /**
     * Obtiene las tareas filtradas y paginadas.
     *
     * @param int $limit Número máximo de tareas a obtener.
     * @param int $offset Desplazamiento para la paginación.
     * @param array $filters Filtros a aplicar.
     * @return array Arreglo de tareas.
     */
    public static function getFilteredTasks($limit, $offset, $filters)
    {
        $db = SingletonDB::getInstance();
        $sql = "SELECT * 
        FROM task 
        WHERE 1=1";
        if ($filters['estado']) {
            $sql .= " AND estado = '{$filters['estado']}'";
        }
        if ($filters['id']) {
            $sql .= " AND task_id {$filters['idCriterio']} {$filters['id']}";
        }
        if ($filters['fechaCreacion']) {
            $sql .= " AND fecha_creacion {$filters['fechaCreacionCriterio']} '{$filters['fechaCreacion']}'";
        }
        if ($filters['fechaRealizacion']) {
            $sql .= " AND fecha_realizacion {$filters['fechaRealizacionCriterio']} '{$filters['fechaRealizacion']}'";
        }
    
        $sql .= " ORDER BY fecha_creacion DESC LIMIT :limit OFFSET :offset";
        $stmt = $db->conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($tasks as &$task) {
            $task['fecha_creacion'] = date('d-m-Y', strtotime($task['fecha_creacion']));
            if ($task['fecha_realizacion'] != null) {
                $task['fecha_realizacion'] = date('d-m-Y', strtotime($task['fecha_realizacion']));
            }
        }
    
        return $tasks;
    }

    /**
     * Obtiene todas las provincias.
     *
     * @return PDOStatement Resultado de la consulta.
     */
    public static function getProvincias()
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "SELECT cod, nombre, comunidad_id
        FROM tbl_provincias
        ORDER BY nombre";
        $result = $db->conn->query($sql);
        return $result;
    }

    /**
     * Obtiene el nombre de una provincia por su ID.
     *
     * @param string $id El ID de la provincia.
     * @return string|false El nombre de la provincia si se encuentra, o false si no se encuentra.
     */
    public static function getProvinciaNameById($id)
    {
        $db = SingletonDB::getInstance();
        $stmt = $db->conn->prepare('SELECT nombre FROM tbl_provincias WHERE cod = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    /**
     * Inserta una nueva tarea en la base de datos.
     *
     * @param object $task Objeto con los datos de la tarea.
     * @return bool Resultado de la operación.
     */
    public static function insertTask($task)
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "INSERT INTO task (num_fiscal_cliente, nombre, apell, tlf, descripcion, email, direccion, poblacion, 
        codigo_post, provincia, estado, fecha_creacion, operario_id, fecha_realizacion, anotaciones_anteriores, 
        anotaciones_posteriores, fich_resu, foto)
        VALUES (" . 
            (($task->num_fiscal_cliente !== null && $task->num_fiscal_cliente != '') ? "'$task->num_fiscal_cliente'" : "11111111") . "," . 
            (($task->nombre !== null && $task->nombre != '') ? "'$task->nombre'" : "NULL") . ", " . 
            (($task->apell !== null && $task->apell != '') ? "'$task->apell'" : "NULL") . ", " . 
            (($task->tlf !== null && $task->tlf != '') ? "'$task->tlf'" : "NULL") . ", " . 
            (($task->descripcion !== null && $task->descripcion != '') ? "'$task->descripcion'" : "NULL") . ", " . 
            (($task->email !== null && $task->email != '') ? "'$task->email'" : "NULL") . ", " . 
            (($task->direccion !== null && $task->direccion != '') ? "'$task->direccion'" : "NULL") . ", " . 
            (($task->poblacion !== null && $task->poblacion != '') ? "'$task->poblacion'" : "NULL") . ", " . 
            (($task->codigo_post !== null && $task->codigo_post != '') ? "'$task->codigo_post'" : "NULL") . ", " . 
            (($task->provincia !== null && $task->provincia != 0) ? "'$task->provincia'" : "NULL") . ", " . 
            (($task->estado !== null && $task->estado != '') ? "'$task->estado'" : "NULL") . ", " . 
            (($task->fecha_creacion !== null && $task->fecha_creacion != '') ? "'$task->fecha_creacion'" : "'1111-11-11'") . ", " . 
            (($task->operario !== null && $task->operario != 0) ? "'$task->operario'" : "NULL") . ", " . 
            (($task->fecha_realizacion !== null && $task->fecha_realizacion != '') ? "'$task->fecha_realizacion'" : "NULL") . ", " . 
            (($task->anotaciones_anteriores !== null && $task->anotaciones_anteriores != '') ? "'$task->anotaciones_anteriores'" : "NULL") . ", " . 
            (($task->anotaciones_posteriores !== null && $task->anotaciones_posteriores != '') ? "'$task->anotaciones_posteriores'" : "NULL") . ", " . 
            (($task->fich_resu !== null && $task->fich_resu != '') ? "'$task->fich_resu'" : "NULL") . ", " . 
            (($task->foto !== null && $task->foto != '') ? "'$task->foto'" : "NULL") .  ")";
            $result = $db->conn->query($sql);
        return $result;
    }

    /**
     * Actualiza una tarea.
     *
     * @param object $updatedTask Objeto con los datos actualizados de la tarea.
     * @param int $id ID de la tarea a actualizar.
     * @return bool Resultado de la operación.
     */
    public static function updateTask($updatedTask, $id)
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "UPDATE task 
        SET num_fiscal_cliente = " . 
            (($updatedTask->num_fiscal_cliente !== null && $updatedTask->num_fiscal_cliente != '') ? "'$updatedTask->num_fiscal_cliente'" : "11111111") . ", " . 
            "nombre = " . 
            (($updatedTask->nombre !== null && $updatedTask->nombre != '') ? "'$updatedTask->nombre'" : "NULL") . ", " . 
            "apell = " . 
            (($updatedTask->apell !== null && $updatedTask->apell != '') ? "'$updatedTask->apell'" : "NULL") . ", " . 
            "tlf = " . 
            (($updatedTask->tlf !== null && $updatedTask->tlf != '') ? "'$updatedTask->tlf'" : "NULL") . ", " . 
            "descripcion = " . 
            (($updatedTask->descripcion !== null && $updatedTask->descripcion != '') ? "'$updatedTask->descripcion'" : "NULL") . ", " . 
            "email = " . 
            (($updatedTask->email !== null && $updatedTask->email != '') ? "'$updatedTask->email'" : "NULL") . ", " . 
            "direccion = " . 
            (($updatedTask->direccion !== null && $updatedTask->direccion != '') ? "'$updatedTask->direccion'" : "NULL") . ", " . 
            "poblacion = " . 
            (($updatedTask->poblacion !== null && $updatedTask->poblacion != '') ? "'$updatedTask->poblacion'" : "NULL") . ", " . 
            "codigo_post = " . 
            (($updatedTask->codigo_post !== null && $updatedTask->codigo_post != '') ? "'$updatedTask->codigo_post'" : "NULL") . ", " . 
            "provincia = " . 
            (($updatedTask->provincia !== null && $updatedTask->provincia != 0) ? "'$updatedTask->provincia'" : "NULL") . ", " . 
            "estado = " . 
            (($updatedTask->estado !== null && $updatedTask->estado != '') ? "'$updatedTask->estado'" : "NULL") . ", " .
            "fecha_creacion = " . 
            (($updatedTask->fecha_creacion !== null && $updatedTask->fecha_creacion != '') ? "'$updatedTask->fecha_creacion'" : "'1111-11-11'") . ", " .
            "operario_id = " . 
            (($updatedTask->operario !== null && $updatedTask->operario != 0) ? "'$updatedTask->operario'" : "NULL") . ", " .
            "fecha_realizacion = " . 
            (($updatedTask->fecha_realizacion !== null && $updatedTask->fecha_realizacion != '') ? "'$updatedTask->fecha_realizacion'" : "NULL") . ", " .
            "anotaciones_anteriores = " . 
            (($updatedTask->anotaciones_anteriores !== null && $updatedTask->anotaciones_anteriores != '') ? "'$updatedTask->anotaciones_anteriores'" : "NULL") . ", " .
            "anotaciones_posteriores = " . 
            (($updatedTask->anotaciones_posteriores !== null && $updatedTask->anotaciones_posteriores != '') ? "'$updatedTask->anotaciones_posteriores'" : "NULL") . ", " .
            "fich_resu = " . 
            (($updatedTask->fich_resu !== null && $updatedTask->fich_resu != '') ? "'$updatedTask->fich_resu'" : "NULL") . ", " .
            "foto = " . 
            (($updatedTask->foto !== null && $updatedTask->foto != '') ? "'$updatedTask->foto'" : "NULL") . "
            WHERE task_id = $id";
        $result = $db->conn->query($sql);
    }

    /**
     * Actualiza una tarea como operario.
     *
     * @param object $updatedTask Objeto con los datos actualizados de la tarea.
     * @param int $id ID de la tarea a actualizar.
     * @return bool Resultado de la operación.
     */
    public static function completeTask($completedTask, $id)
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "UPDATE task 
        SET estado = " . 
            (($completedTask->estado !== null && $completedTask->estado != '') ? "'$completedTask->estado'" : "NULL") . ", " .
            "fecha_realizacion = " . 
            (($completedTask->fecha_realizacion !== null && $completedTask->fecha_realizacion != '') ? "'$completedTask->fecha_realizacion'" : "NULL") . ", " .
            "anotaciones_anteriores = " . 
            (($completedTask->anotaciones_anteriores !== null && $completedTask->anotaciones_anteriores != '') ? "'$completedTask->anotaciones_anteriores'" : "NULL") . ", " .
            "anotaciones_posteriores = " . 
            (($completedTask->anotaciones_posteriores !== null && $completedTask->anotaciones_posteriores != '') ? "'$completedTask->anotaciones_posteriores'" : "NULL") . ", " .
            "fich_resu = " . 
            (($completedTask->fich_resu !== null && $completedTask->fich_resu != '') ? "'$completedTask->fich_resu'" : "NULL") . ", " .
            "foto = " . 
            (($completedTask->foto !== null && $completedTask->foto != '') ? "'$completedTask->foto'" : "NULL") . "
            WHERE task_id = $id";
        echo $sql;
        $result = $db->conn->query($sql);
    }

    /**
     * Elimina una tarea por su ID.
     *
     * @param int $id ID de la tarea a eliminar.
     * @return bool Resultado de la operación.
     */
    public static function deleteTask($id)
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "DELETE FROM task 
        WHERE task_id = $id";
        $result = $db->conn->query($sql);
    }

    /**
     * Obtiene todos los operarios.
     *
     * @return array Arreglo de operarios.
     */
    public static function getOperarios()
    {
        $db = SingletonDB::getInstance();
        $sql = "SELECT id, usuario FROM usuarios WHERE status = 'O'";
        $result = $db->conn->query($sql);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Verifica las credenciales de un usuario.
     *
     * @param string $user Nombre de usuario.
     * @param string $pass Contraseña del usuario.
     * @return bool True si las credenciales son correctas, false en caso contrario.
     */
    public static function checkUser($user, $pass)
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "SELECT usuario, password, status
        FROM usuarios
        WHERE usuario = '$user' AND password = '$pass'";
        $result = $db->conn->query($sql);
        $user = $result->fetch(\PDO::FETCH_ASSOC);
        return ($user) ? true : false;
    }

    /**
     * Obtiene un usuario por sus credenciales.
     *
     * @param string $user Nombre de usuario.
     * @param string $pass Contraseña del usuario.
     * @return array|null Usuario encontrado o null si no existe.
     */
    public static function getUser($user, $pass)
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "SELECT usuario, password, status
        FROM usuarios
        WHERE usuario = '$user' AND password = '$pass'";
        $result = $db->conn->query($sql);
        $user = $result->fetch(\PDO::FETCH_ASSOC);
        return $user;
    }

    /**
     * Elimina los archivos de una tarea.
     *
     * @param string $campo Campo a actualizar.
     * @param int $id ID de la tarea.
     * @return bool Resultado de la operación.
     */
    public static function deleteFicheros($campo, $id)
    {
        $db = SingletonDB::getInstance();
        $sql = 
        "UPDATE task 
        SET $campo = NULL
        WHERE task_id = $id";
        $result = $db->conn->query($sql);
    }

    /**
     * Obtiene todos los usuarios.
     *
     * @return array Arreglo de usuarios.
     */
    public static function getUsuarios()
    {
        $db = SingletonDB::getInstance();
        $sql = "SELECT * FROM usuarios";
        $result = $db->conn->query($sql);
        return $result->fetchAll(\PDO::FETCH_OBJ);
    }

    /**
     * Crea un nuevo usuario.
     *
     * @param string $usuario Nombre de usuario.
     * @param string $password Contraseña del usuario.
     * @param string $status Estado del usuario.
     * @return bool Resultado de la operación.
     */
    public static function crearUsuario($usuario, $password, $status)
    {
        $db = SingletonDB::getInstance();
        $sql = "INSERT INTO usuarios (usuario, password, status) VALUES ('$usuario', '$password', '$status')";
        $db->conn->query($sql);
    }

    /**
     * Obtiene un usuario por su ID.
     *
     * @param int $id ID del usuario.
     * @return object Usuario encontrado.
     */
    public static function getUsuarioById($id)
    {
        $db = SingletonDB::getInstance();
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        $result = $db->conn->query($sql);
        return $result->fetch(\PDO::FETCH_OBJ);
    }

    /**
     * Obtiene el nombre de usuario por su ID.
     *
     * @param int $id ID del usuario.
     * @return array Nombre de usuario.
     */
    public static function getUsuarioNameById($id)
    {
        $db = SingletonDB::getInstance();
        $sql = "SELECT usuario FROM usuarios WHERE id = $id";
        $result = $db->conn->query($sql);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Edita un usuario.
     *
     * @param int $id ID del usuario.
     * @param string $usuario Nombre de usuario.
     * @param string $password Contraseña del usuario.
     * @param string $status Estado del usuario.
     * @return bool Resultado de la operación.
     */
    public static function editarUsuario($id, $usuario, $password, $status)
    {
        $db = SingletonDB::getInstance();
        $sql = "UPDATE usuarios SET usuario = '$usuario', password = '$password', status = '$status' WHERE id = $id";
        $db->conn->query($sql);
    }

    /**
     * Elimina un usuario por su ID.
     *
     * @param int $id ID del usuario.
     * @return bool Resultado de la operación.
     */
    public static function eliminarUsuario($id)
    {
        $db = SingletonDB::getInstance();
        $sql = "DELETE FROM usuarios WHERE id = $id";
        $db->conn->query($sql);
    }

}