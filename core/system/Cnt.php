<?php

/**
 * Archivo ccore/system/Cnt.php
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
     * Inicializa las variables directorio raíz y de ejecución
     * @param string $raiz Directorio raíz de la aplicación
     * @param string $ejec Directorio de ejecución la aplicación
     */
    public static function fijar($raiz, $ejec, $sufijo_url = '') {
        self::$dir_raiz = $raiz;
        self::$dir_ejec = $raiz . $ejec;
        self::$sufijo_url = $sufijo_url;
    }

    /**
     * Muestra información de una variable
     * @param mixed $var Variable
     */
    public static function info($var) {
        var_dump($var);
        exit(0);
    }

    public static function br() {
        return '<br>';
    }

}
