<?php

/**
 * Archivo core/system/Cnt.php
 * 
 * @copyright (c) 2015, KintuCms
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/**
 * Almacena las variables globales de la aplicación
 * 
 * Esta clase proporciona atributos y métodos que ayudan a almacenar y a
 * recuperar variables globales de la aplicación, algo similar a las constantes
 */
class Cnt {

    /**
     * @var string Directorio raíz de la aplicación
     */
    public static $dir_raiz = '';

    /**
     * @var string Directorio de ejecución la aplicación
     */
    public static $dir_ejec = '';

    /**
     * @var string Directorio de las vistas
     */
    public static $dir_vista = '';

    /**
     * @var string Directorio admin
     */
    public static $sufijo_url = '';

    /**
     * @var string Url de la plantilla 
     */
    public static $url_plan = '';

    /**
     * Inicializa las variables directorio raíz y de ejecución
     * @param string $raiz Directorio raíz de la aplicación
     * @param string $ejec Directorio de ejecución la aplicación
     * @param string $sufijo_url Sufijo de la url, por ejemplo admin/
     */
    public static function fijar($raiz, $ejec, $sufijo_url = '') {
        self::$dir_raiz = $raiz;
        self::$dir_ejec = $raiz . $ejec;
        self::$sufijo_url = $sufijo_url;
    }

    /**
     * Establece el directorio de las vistas
     * @param string $vista Directorio de la vista
     */
    public static function setDirVista($vista) {
        self::$dir_vista = $vista;
        if (self::$sufijo_url != '') {
            self::$url_plan = 'publico/plantilla/admin/';
        } else {
            self::$url_plan = 'publico/plantilla/' . Config::$plantilla . '/';
        }
    }

    /**
     * Muestra información de una variable
     * @param mixed $var Variable
     */
    public static function info($var) {
        var_dump($var);
        exit(0);
    }

    /**
     * Retorna salto de línea en html
     * @return string
     */
    public static function br() {
        return '<br>';
    }

}
