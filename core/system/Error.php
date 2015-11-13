<?php

/**
 * Archivo Error.php
 * 
 * Este archivo define la clase Error.
 * 
 * @license http://licencia licencia
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @version 1.0 18/06/2015 21:48:00 
 */

/**
 * Clase Error
 * 
 * Clase que gestiona (registra en logs) los errores
 */
class Error {

    /**
     * 
     * @param type $mensaje
     */
    public static function escribir($mensaje) {
        $_nombre = date('d-m-Y') . '_' . substr(md5(date('dYm')), 22) . '.txt';
        $gestor = fopen(KC_RAIZ . 'app/log/' . $_nombre, 'a');
        if ($gestor) {
            fwrite($gestor, date('H:i:s') . '#;');
            fwrite($gestor, RUTA . ADMIN . Uri::$url . '#;');
            fwrite($gestor, $mensaje . '#; ');
            fwrite($gestor, Sesion::get('login') . PHP_EOL);
            fclose($gestor);
        }
    }

    /**
     * Registra los errores y muestra el error
     * @param string $mensaje ddescripción del error
     */
    public static function manejo($mensaje, $detalle) {
        define('ES_ERROR', TRUE);
        self::escribir($mensaje);
        Route::error($mensaje, $detalle);
    }

    public static function mysql($codigo, $detalle) {
        $_error = array(
            '2002' => 'No se pudo conectar con el servidor MySQL, error en constante "DB_HOST"',
            '2005' => 'No se pudo conectar con el servidor MySQL, error en constante "DB_HOST"',
            '1044' => 'Acceso denegado a MySQL, error en constante "DB_USER"',
            '1045' => 'Acceso denegado a MySQL, error en constante "DB_PASS"',
            '1049' => 'La base de datos no existe en MySQL, error en constante "DB_NAME"',
            '1064' => 'Error de sintaxis MySQL, compruebe su consulta',
            '1146' => 'Error de sintaxis MySQL, la tabla no existe',
            '1054' => 'Error de MySQL, columna no existente',
            '1136' => 'Error de MySQL, no hay correspondencia en numero de columnas');
        if (key_exists($codigo, $_error)) {
            self::manejo($codigo . ': ' . $_error[$codigo], $detalle);
        } else {
            self::manejo($codigo . ': Se ha producido un error de MySQL', $detalle);
        }
    }

    public static function oops($nombre) {
        echo $nombre;
        exit();
    }

}
