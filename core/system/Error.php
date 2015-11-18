<?php

/**
 * Archivo ccore/system/Error.php
 * 
 * @copyright (c) 2015, KintuCms
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/**
 * Administra los errores
 * 
 * Esta clase proporciona atributos y métodos que ayudan a manejar a los
 * errores de la aplicación 
 */
class Error {

    /**
     * Escribe un mensaje de error
     * 
     * Método que escribe un mensaje en un archivo de la carpeta app/log/ 
     * @param string $mensaje Mensaje de error
     */
    private static function log($mensaje) {
        $_nombre = date('d-m-Y') . '_' . substr(md5(date('dYm')), 22) . '.txt';
        $gestor = fopen(Cnt::$dir_raiz . 'log/' . $_nombre, 'a');
        if ($gestor) {
            fwrite($gestor, date('H:i:s') . '#;');
            fwrite($gestor, Cnt::$sufijo_url . Ruteo::$url . '#;');
            fwrite($gestor, $mensaje . '#; ' . PHP_EOL);
            fclose($gestor);
        }
    }

    /**
     * Muestra una página de error con detalles del error
     * 
     * Método que escribe el log y ejecuta el método error de Ruteo
     * @param string $mensaje Mensaje corto
     * @param string $detalle Mensaje detallado
     */
    public static function mostrar($mensaje, $detalle) {
        self::log($mensaje);
        $ruta = Ruteo::getInstancia();
        $ruta->error($mensaje, $detalle);
    }

    /**
     * Muestra errores de MySQL
     * 
     * Método que maneja los errores de MySQL
     * @param int $codigo
     * @param string $detalle
     */
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
            self::mostrar($_error[$codigo], $detalle);
        } else {
            self::mostrar('Error de MySQL: ' . $codigo, $detalle);
        }
    }

}
