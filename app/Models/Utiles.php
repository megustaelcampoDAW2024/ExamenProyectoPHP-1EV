<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utiles extends Model
{
    /**
     * Filtra el formulario y anota errores si los hay.
     *
     * @param object $errores Objeto para anotar errores.
     */
    function filtroForm($errores){
        foreach($_POST as $name => $valor){
            if($name != '_token'){
                if($name == "descripcion")
                    if($this->valorPost($name) == '')
                        $errores -> AnotaError($name, "Rellenar la Descripción es Obligatorio");
                if($name == "nombre")
                    if($this->valorPost($name) == '')
                        $errores -> AnotaError($name, "Rellenar el Nombre del Cliente es Obligatorio");
                if($name == "apell")
                    if($this->valorPost($name) == '')
                        $errores -> AnotaError($name, "Rellenar el Apellido del Cliente es Obligatorio");
                if($name == "num-fiscal-cliente"){
                    if($this->valorPost($name) == '')
                        $errores -> AnotaError($name, "Rellenar el DNI/NIE es Obligatorio");
                    else if(!$this->validDniCifNie($valor))
                        $errores -> AnotaError($name, "El DNI es incorrecto <br>[XXXXXXXXL]");
                }if($name == "tlf"){
                    if($this->valorPost($name) == '')
                        $errores -> AnotaError($name, "Rellenar el Teléfono es Obligatorio");
                    else if(!$this->validarTelefono($valor))
                        $errores -> AnotaError($name, "El Teléfono es Incorrecto <br>[+PP NNN NNN NNN]<br>[+PP NNN NN NN NN]
                        <br>[+PP-NNN-NNN-NNN]<br>[+PP-NNN-NN-NN-NN]");
                }if($name == "codigo-post")
                    if(!$this->valorPost($name) == '')
                        if(!$this->validarCodigoPostal($valor))
                            $errores -> AnotaError($name, "El Código Postal es Incorrecto <br>[XXXXX]");
                        else if(!$this->valorPost('provincia') == 0)
                            if (substr($this->valorPost($name), 0, 2) != $this->valorPost('provincia')) {
                                $errores->AnotaError($name, "La Codigo Postal no coincide con la Provincia");
                            }
                if($name == "email"){
                    if($this->valorPost($name) == '')
                        $errores -> AnotaError($name, "Rellenar el e-Mail es Obligatorio");
                    else if(!$this->validarEmail($valor))
                        $errores -> AnotaError($name, "El eMail es Incorrecto<br>[ejemplo@ejemplo.extensión]");
                }if($name == "fecha-realizacion")
                    if(!$this->valorPost($name) == '')
                        if(!$this->validarFechaPosterior($_POST['fecha-creacion'], $valor))
                            $errores -> AnotaError($name, "La Fecha es Incorrecta <br>[DD/MM/AAAA]<br>[DD-MM-AAAA]");
                if($name == "operario")
                    if($this->valorPost($name) == 0)
                        $errores -> AnotaError($name, "Seleccionar un Operario es Obligatorio");
            }
        }
    }

    /**
     * Obtiene el valor de un campo POST.
     *
     * @param string $nombreCampo Nombre del campo.
     * @return string Valor del campo.
     */
    static function valorPost($nombreCampo){
        if (isset($_POST[$nombreCampo])){
            return $_POST[$nombreCampo];
        }
        else
            return '';
    }

    /**
     * Aplica estilo de color a la etiqueta si hay un error.
     *
     * @param string $name Nombre del campo.
     * @param object $errores Objeto para verificar errores.
     */
    function colorLabel($name, $errores){
        if($errores -> HayError($name))
            echo  'style="color: red;"';
    }

    /**
     * Muestra el contenido de la etiqueta, incluyendo errores si los hay.
     *
     * @param string $name Nombre del campo.
     * @param string $nomLabel Nombre de la etiqueta.
     * @param object $errores Objeto para verificar errores.
     */
    function contenidoLabel($name, $nomLabel, $errores){
        if($_POST){
            if($errores -> HayError($name))
                echo $errores -> Error($name);
            else
                echo $nomLabel;
        }else
            echo $nomLabel;
    }

    /**
     * Obtiene la fecha actual en formato 'd-m-Y'.
     *
     * @return string Fecha actual.
     */
    function obtenerFechaActual(){
        return date('d-m-Y');
    }

    /**
     * Valida el formato del número de teléfono.
     *
     * @param string $telefono Número de teléfono.
     * @return bool True si es válido, false en caso contrario.
     */
    function validarTelefono($telefono){
        $telefono = str_replace([' ', '-'], '', $telefono);
        $patronH = "/^\+";
        return preg_match('/^\+\d{2}\d{9}$/', $telefono) === 1;
    }

    /**
     * Valida el formato del código postal.
     *
     * @param string $codigoPostal Código postal.
     * @return bool True si es válido, false en caso contrario.
     */
    function validarCodigoPostal($codigoPostal){
        return preg_match('/^\d{5}$/', $codigoPostal) === 1;
    }

    /**
     * Valida el formato del correo electrónico.
     *
     * @param string $email Correo electrónico.
     * @return bool True si es válido, false en caso contrario.
     */
    function validarEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Valida si una fecha es posterior a otra.
     *
     * @param string $fechaInicial Fecha inicial.
     * @param string $fechaNueva Fecha nueva.
     * @return bool True si la fecha nueva es posterior, false en caso contrario.
     */
    function validarFechaPosterior($fechaInicial, $fechaNueva){
        $fechaNuevaValida = preg_match('/^\d{2}[-\/]\d{2}[-\/]\d{4}$/', $fechaNueva) === 1;
        if (!$fechaNuevaValida) {
            return false;
        }
        // Convertir las fechas a timestamps.
        $timestampInicial = strtotime($fechaInicial);
        $timestampNueva = strtotime($fechaNueva);
        // Verificar si la fecha nueva es posterior a la fecha inicial.
        return $timestampNueva > $timestampInicial;
    }

    /**
     * Valida un DNI (NIF), CIF o NIE.
     *
     * @param string $dni Número de identificación.
     * @return bool True si es válido, false en caso contrario.
     */
    function validDniCifNie($dni){
        $cif = strtoupper($dni);
        for ($i = 0; $i < 9; $i ++){
            $num[$i] = substr($cif, $i, 1);
        }
        // Si no tiene un formato valido devuelve error
        if (!preg_match('/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/', $cif)){
            return false;
        }
        // Comprobacion de NIFs estandar
        if (preg_match('/(^[0-9]{8}[A-Z]{1}$)/', $cif)){
            if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 0, 8) % 23, 1)){
                return true;
            }else{
                return false;
            }
        }
        // Algoritmo para comprobacion de codigos tipo CIF
        $suma = $num[2] + $num[4] + $num[6];
        for ($i = 1; $i < 8; $i += 2){
            $suma += (int)substr((2 * $num[$i]),0,1) + (int)substr((2 * $num[$i]), 1, 1);
        }
        $n = 10 - substr($suma, strlen($suma) - 1, 1);
        // Comprobacion de NIFs especiales (se calculan como CIFs o como NIFs)
        if (preg_match('/^[KLM]{1}/', $cif)){
            if ($num[8] == chr(64 + $n) || $num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 1, 8) % 23, 1)){
                return true;
            }else{
                return false;
            }
        }
        // Comprobacion de CIFs
        if (preg_match('/^[ABCDEFGHJNPQRSUVW]{1}/', $cif)){
            if ($num[8] == chr(64 + $n) || $num[8] == substr($n, strlen($n) - 1, 1)){
                return true;
            }else{
                return false;
            }
        }
        // Comprobacion de NIEs
        // T
        if (preg_match('/^[T]{1}/', $cif)){
            if ($num[8] == preg_match('/^[T]{1}[A-Z0-9]{8}$/', $cif)){
                return true;
            }else{
                return false;
            }
        }
        // XYZ
        if (preg_match('/^[XYZ]{1}/', $cif)){
            if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr(str_replace(array('X','Y','Z'), array('0','1','2'), $cif), 0, 8) % 23, 1)){
                return true;
            }else{
                return false;
            }
        }
        // Si todavía no se ha verificado devuelve error
        return false;
    }
    
}