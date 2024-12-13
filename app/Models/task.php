<?php

namespace App\Models;

use App\Models\Utiles;

/**
 * Clase Task
 * 
 * Representa una tarea con varios atributos como información del cliente, descripción, estado y marcas de tiempo.
 */
class Task
{
    /**
     * @var string Número fiscal del cliente
     */
    public $num_fiscal_cliente;

    /**
     * @var string Nombre del cliente
     * @var string Apellido del cliente
     * @var string Número de teléfono del cliente
     * @var string Dirección de correo electrónico del cliente
     */
    public $nombre, $apell, $tlf, $email;

    /**
     * @var string Descripción de la tarea
     */
    public $descripcion;

    /**
     * @var string Dirección de la tarea
     * @var string Ciudad de la tarea
     * @var string Código postal de la tarea
     * @var string Provincia de la tarea
     */
    public $direccion, $poblacion, $codigo_post, $provincia;

    /**
     * @var string Estado de la tarea
     */
    public $estado;

    /**
     * @var string Fecha de creación de la tarea
     * @var string|null Fecha de realización de la tarea
     */
    public $fecha_creacion, $fecha_realizacion;

    /**
     * @var string Operario de la tarea
     */
    public $operario;

    /**
     * @var string Anotaciones anteriores
     * @var string Anotaciones posteriores
     */
    public $anotaciones_anteriores, $anotaciones_posteriores;

    /**
     * @var string Archivo resumen
     * @var string Foto
     */
    public $fich_resu, $foto;

    /**
     * Constructor de la clase Task.
     * Inicializa las propiedades de la tarea usando valores POST.
     */
    public function __construct()
    {
        $this->num_fiscal_cliente = strtoupper(Utiles::ValorPost('num-fiscal-cliente'));
        $this->nombre = Utiles::ValorPost('nombre');
        $this->apell = Utiles::ValorPost('apell');
        $this->tlf = Utiles::ValorPost('tlf');
        $this->descripcion = Utiles::ValorPost('descripcion');
        $this->email = Utiles::ValorPost('email');
        $this->direccion = Utiles::ValorPost('direccion');
        $this->poblacion = Utiles::ValorPost('poblacion');
        $this->codigo_post = Utiles::ValorPost('codigo-post');
        $this->provincia = Utiles::ValorPost('provincia');
        $this->estado = Utiles::ValorPost('estado');
        $this->fecha_creacion = date('Y-m-d H:i:s', strtotime(Utiles::ValorPost('fecha-creacion')));
        $this->operario = Utiles::ValorPost('operario');
        $this->fecha_realizacion = (Utiles::ValorPost('fecha-realizacion') == '')? null : date('Y-m-d H:i:s', strtotime(Utiles::ValorPost('fecha-realizacion')));
        $this->anotaciones_anteriores = Utiles::ValorPost('anotaciones-anteriores');
        $this->anotaciones_posteriores = Utiles::ValorPost('anotaciones-posteriores');
        $this->fich_resu = Utiles::ValorPost('fich-resu');
        $this->foto = Utiles::ValorPost('foto');
    }
}
?>