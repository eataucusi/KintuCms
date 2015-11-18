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
    public static $url_admin = '';

    /**
     * Inicializa las variables directorio raíz y de ejecución
     * 
     * Método que fija las variables directorio raíz y directorios de ejecución
     * @param string $raiz Directorio raíz de la aplicación
     * @param string $ejec Directorio de ejecución la aplicación
     */
    public static function fijar($raiz, $ejec, $admin = '') {
        self::$dir_raiz = $raiz;
        self::$dir_ejec = $raiz . $ejec;
        self::$url_admin = $admin;
    }

}
