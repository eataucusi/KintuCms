<?php

/**
 * Archivo core/system/Uri.php
 * 
 * @copyright (c) 2015, KintuCms
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/**
 * Administra las rutas o peticiones
 * 
 * Esta clase proporciona atributos y métodos que ayudan a recuperar información
 * de las cadenas URI, las peticiones a la aplicación se hace de la forma
 * "controlador/método/param1/param2/..../paramN", esta clase extrae el
 * controlador y el método y agrupa los argumentos en un arreglo
 */
class Uri {

    /**
     * @var Uri Instancia de la clase Uri
     */
    private static $_instancia;

    /**
     * @var string Controlador de la petición 
     */
    public $contro;

    /**
     * @var string Método de la petición 
     */
    public $metodo;

    /**
     * @var array Parámetros de la petición 
     */
    public $args;

    /**
     * @var string Url saneado de la petición 
     */
    public $url;

    /**
     * 
     */
    private function __construct() {
        
    }

    /**
     * Crea una única instancia de la clase Uri
     * 
     * Método que verifica si existe una instancia de esta clase, si existe
     * retorna esa instancia caso contrario crea una instancia
     * @return Uri Instancia de la clase Uri
     */
    public static function getInstancia() {
        if (!self::$_instancia) {
            self::$_instancia = new self();
        }
        return self::$_instancia;
    }

    public function inputGet($url) {
        if (!is_null(filter_input(INPUT_GET, $variable_name))) {
            
        }
    }

    /**
     * Obtiene las partes de la petición
     * 
     * Extrae el controlador y el método de la petición, si el controlador o
     * método no existe se les asigna un controlador y método por defecto 
     * denominado index, también agrupa los parámetros en un arreglo, si 
     * no existen parámetros se asigna un arreglo vacío.
     */
    public function segmentar() {
        if (!is_null(filter_input(INPUT_GET, 'url'))) {
            $this->url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);

            $_aux = array_filter(explode('/', $this->url));
            $this->contro = strtolower(array_shift($_aux));
            $this->metodo = strtolower(array_shift($_aux));
            $this->args = $_aux;

            if (empty($this->metodo)) {
                $this->metodo = 'index';
            }
        } else {
            $this->contro = 'index';
            $this->metodo = 'index';
            $this->args = array();
        }
    }

}
