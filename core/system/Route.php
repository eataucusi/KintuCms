<?php

/**
 * Archivo ccore/system/Route.php
 * 
 * @copyright (c) 2015, KintuCms
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/**
 * Analiza URI y determina el enrutamiento
 * 
 * 
 */
class Route {

    /**
     * Función que incluye el controlador y ejecuta el método con sus 
     * respectivos parámetros, con ayuda de Petición.
     */
    public static function ejecutar() {
        Uri::segmentar();
        $rutaControlador = KC_EXE . 'Controller/' . Uri::$controller . '.php';
        if (!is_readable($rutaControlador)) {
            self::error('Controlador ' . Uri::$controller . ' no encontrado', 'No existe el archivo: ' . $rutaControlador);
        }
        require_once $rutaControlador;
        $nombre = Uri::$controller . 'Controller';
        if (!class_exists($nombre, FALSE)) {
            self::error('Controlador ' . Uri::$controller . ' no encontrado', 'La clase no ha sido definida en el archivo: ' . $rutaControlador);
        }
        $controlador = new $nombre;
        if (!is_callable(array($controlador, Uri::$method))) {
            self::error('Metodo ' . Uri::$method . ' no se puede ejecutar', ' Metodo ' . Uri::$method . ' no definido o inaccesible en ' . $rutaControlador);
        }
        define('KC_VIEW', KC_EXE . 'View/');
        call_user_func_array(array($controlador, Uri::$method), Uri::$args);
    }

    public static function error($mensaje, $detalle) {
        require_once KC_RAIZ . 'core/Controller/error.php';


        exit();
    }

}
