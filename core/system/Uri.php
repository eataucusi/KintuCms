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
 * controlador y el método y agrupa los argumentos en un arreglo.
 */
class Uri {

    /**
     * @var string Controlador de la petición 
     */
    public static $controller;

    /**
     * @var string Método de la petición 
     */
    public static $method;

    /**
     * @var array Parámetros de la petición 
     */
    public static $args;

    /**
     * @var string Url saneado de la petición 
     */
    private static $url;

    /**
     * Obtiene las partes de la petición
     * 
     * Extrae el controlador y el método de la petición, si el controlador o
     * método no existe se les asigna un controlador y método por defecto 
     * denominado index; también agrupa los parámetros en un arreglo, si 
     * no existen parámetros se asigna un arreglo vacío.
     */
    public static function segmentar() {
        if (!is_null(filter_input(INPUT_GET, 'url'))) {
            self::$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);

            $_aux = array_filter(explode('/', self::$url));
            self::$controller = strtolower(array_shift($_aux));
            self::$method = strtolower(array_shift($_aux));
            self::$args = $_aux;

            if (empty(self::$method)) {
                self::$method = 'index';
            }
        } else {
            self::$controller = 'index';
            self::$method = 'index';
            self::$args = array();
        }
    }

}
