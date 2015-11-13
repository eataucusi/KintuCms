<?php

/**
 * Archivo core/system/Input.php
 * 
 * @copyright (c) 2015, KintuCms
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/**
 * Valida y sanea los datos recibidos por post o get
 * 
 * Esta clase proporciona atributos y métodos que ayudan a validar, sanear y
 * recuperar datos recibidos por post o get
 */
class Input {

    /**
     * @var Input Instancia de la clase Input
     */
    private static $_instancia;

    /**
     * @var array Datos recibidos
     */
    public $copia;

    /**
     * @var array Datos ricibidos sanedos y limpios
     */
    public $limpio;

    /**
     * Constructor privado para que esta clase no sea instanciado
     */
    private function __construct() {
        $this->dato = array();
        $this->trim('post');
        $this->trim('get');
    }

    /**
     * Crea una única instancia de la clase Input
     * 
     * Método que verifica si existe una instancia de esta clase, si existe
     * retorna esa instancia, caso contrario crea una instancia
     * @return Input Instancia de la clase Input
     */
    public static function getInstancia() {
        if (!self::$_instancia) {
            self::$_instancia = new self();
        }
        return self::$_instancia;
    }

    /**
     * Elimina espacios de los datos recibidos por post o get
     * 
     * Método que aplica la función trim a cada uno de los valores recibidos por
     * post o get
     * @param string $input Método de envío: post o get
     */
    private function trim($input) {
        $inputs = array('get' => INPUT_GET, 'post' => INPUT_POST);
        $_copia = filter_input_array($inputs[$input]);
        if (is_array($_copia)) {
            foreach ($_copia as $clave => $valor) {
                $this->copia[$input][$clave] = trim($valor);
            }
        }
    }

    /**
     * Verifica si un dato ha sido enviado por get o post
     *  
     * Método que verifica si un dato ha sido enviado por un determinado método
     * de envío, si este dato no existe llama al gestor de errores
     * @param string $input Método de envío: get o post
     * @param string $clave Nombre de variable a recibir
     */
    private function existe($input, $clave) {
        if (!isset($this->copia[$input])) {
            Error::oops('no existe el  array ' . $input);
        } elseif (!isset($this->copia[$input][$clave])) {
            Error::oops('no existe el  dato ' . $clave);
        }
    }

    /**
     * Valida el tipo de dato de un valor recibido por post o get
     * 
     * Método que comprueba  el tipo de dato de un valor recibido  por post o
     * get , si el tipo de dato es no soportado o no válido llama al gestor de
     * errores
     * @param string $clave Nombre de variable a recibir
     * @param string $tipo Tipo de dato: int, float, bool, email, url, ip
     * @param string $input Método de envío: get o post
     * @return boolean TRUE si es válido, FALSE caso contrario
     */
    public function evalua($clave, $tipo, $input = 'post') {
        $this->existe($input, $clave);
        $tipos = array('int' => FILTER_VALIDATE_INT,
            'float' => FILTER_VALIDATE_FLOAT, 'bool' => FILTER_VALIDATE_BOOLEAN,
            'email' => FILTER_VALIDATE_EMAIL, 'url' => FILTER_VALIDATE_URL,
            'ip' => FILTER_VALIDATE_IP);
        if (!key_exists($tipo, $tipos)) {
            Error::oops('no se soporta el tipo ' . $tipo);
        } elseif (filter_var($this->copia[$input][$clave], $tipos[$tipo])) {
            $this->limpio[$input][$clave] = $this->copia[$input][$clave];
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Valida con una expresión regular un dato recibido por post o get
     * 
     * Método que realiza una comparación con una expresión regular
     * @param string $clave Nombre de variable a recibir
     * @param string $exp Expresión regular
     * @param string $input Método de envío: get o post
     * @return boolean TRUE si es válido, FALSE caso contrario
     */
    public function evaluaExp($clave, $exp, $input = 'post') {
        $this->existe($input, $clave);
        if (filter_var($this->copia[$input][$clave], FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => $exp)))) {
            $this->limpio[$input][$clave] = $this->copia[$input][$clave];
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Valida como texto a un dato recibido por post o get
     * 
     * Método que comprueba si la longitud de cadena de un dato enviado está 
     * entre los límites permitidos, si tamaño máximo es 0 (cero), el texto no
     * tiene límite superior 
     * @param string $clave Nombre de variable a recibir
     * @param string $input Método de envío: get o post
     * @param array $tam Arreglo con tamaño mínimo y tamaño máximo del texto
     * @return boolean TRUE si es válido, FALSE caso contrario
     */
    public function evaluaTexto($clave, $input = 'post', $tam = array(0, 0)) {
        $this->existe($input, $clave);
        if (count($tam) != 2) {
            Error::oops('Arreglo de tamaño texto mínimo y máximo no válido');
        }
        $_tam = strlen($this->copia[$input][$clave]);
        if ($tam[1] == 0) {
            if ($tam[0] <= $_tam) {
                $this->limpio[$input][$clave] = htmlentities($this->copia[$input][$clave], ENT_NOQUOTES);
                return TRUE;
            }
            return FALSE;
        } elseif ($tam[0] <= $_tam && $_tam <= $tam[1]) {
            $this->limpio[$input][$clave] = htmlentities($this->copia[$input][$clave], ENT_NOQUOTES);
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Valida como html a un dato recibido por post o get
     * 
     * Método que comprueba si la longitud de cadena de un dato enviado está 
     * entre los límites permitidos, si tamaño máximo es 0 (cero), el texto no
     * tiene límite superior 
     * @param string $clave Nombre de variable a recibir
     * @param string $input Método de envío: get o post
     * @param array $tam Arreglo con tamaño mínimo y tamaño máximo del texto
     * @return boolean TRUE si es válido, FALSE caso contrario
     */
    public function evaluaHtml($clave, $input = 'post', $tam = array(0, 0)) {
        $this->existe($input, $clave);
        if (count($tam) != 2) {
            Error::oops('Arreglo de tamaño texto mínimo y máximo no válido');
        }
        $_tam = strlen($this->copia[$input][$clave]);
        if ($tam[1] == 0) {
            if ($tam[0] <= $_tam) {
                $this->limpio[$input][$clave] = $this->copia[$input][$clave];
                return TRUE;
            }
            return FALSE;
        } elseif ($tam[0] <= $_tam && $_tam <= $tam[1]) {
            $this->limpio[$input][$clave] = $this->copia[$input][$clave];
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Valida un dato alternativo recibido por post o get
     * 
     * Método que verifica si el dato enviado es vacío o ‘ninguno’, si es así se
     * pone el dato a NULL y es un dato alternativo válido, caso contrario se
     * evalúa de acuerdo al tipo de dato
     * @param string $clave Nombre de variable a recibir
     * @param string $tipo Tipo de dato: string, int, float, bool, email, url, ip
     * @param string $input Método de envío: get o post
     * @return boolean TRUE si es válido, FALSE caso contrario
     */
    public function evaluaAlt($clave, $tipo, $input = 'post') {
        $this->existe($input, $clave);
        if ($this->copia[$input][$clave] == '' || strtolower($this->copia[$input][$clave]) == 'ninguno') {
            $this->limpio[$input][$clave] = NULL;
            return TRUE;
        } elseif ($tipo == 'string') {
            $this->limpio[$input][$clave] = htmlentities($this->copia[$input][$clave], ENT_NOQUOTES);
            return TRUE;
        }
        return $this->evalua($clave, $tipo, $input);
    }

}
