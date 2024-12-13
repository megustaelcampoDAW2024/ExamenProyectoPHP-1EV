<?php
namespace App\Models;
use PDO;

/**
 * Clase SingletonDB
 * 
 * Esta clase implementa el patrón Singleton para gestionar una única instancia de conexión a la base de datos.
 */
class SingletonDB
{ 
    /**
     * @var PDO $conn Conexión a la base de datos
     */
    public $conn;

    /**
     * @var string $dns DNS de la base de datos
     */
    private static $dns = "mysql:host=localhost;dbname=constructora"; 

    /**
     * @var string $user Usuario de la base de datos
     */
    private static $user = "root";

    /**
     * @var string $pass Contraseña de la base de datos
     */
    private static $pass = "";

    /**
     * @var SingletonDB $instance Instancia única de la clase
     */
    private static $instance;

    /**
     * Constructor de la clase
     * 
     * Inicializa la conexión a la base de datos utilizando PDO.
     */
    public function __construct ()
    {
       $this->conn = new PDO(self::$dns,self::$user,self::$pass, array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
    ));
    }

    /**
     * Obtiene la instancia única de la clase
     * 
     * @return SingletonDB La instancia única de la clase
     */
    public static function getInstance()
    { 
        if(!isset(self::$instance)) 
        { 
            $object= __CLASS__;
            self::$instance=new $object;
        } 
        return self::$instance;
    }
}
?>