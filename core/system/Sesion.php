<?php

/**
 * Archivo core/system/Sesion.php
 * 
 * @copyright (c) 2015, KintuCms
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/**
 * Gestiona las sesiones
 * 
 * Esta clase proporciona métodos que ayudan a almacenar y recuperar información
 * de la variable $_SESSION
 */
class Sesion {

    /**
     * Inicia la sesión
     */
    public static function iniciar() {
        session_start();
        self::tiempo();
    }

    /**
     * Elimina y destruye la sesión
     */
    public static function apagar() {
        unset($_SESSION);
        session_destroy();
    }

    /**
     * Almacena una variable en la sesión
     * @param string $clave Nombre de variable
     * @param mixed $valor Valor a almacenar
     */
    public static function poner($clave, $valor) {
        $_SESSION[Config::$id . '_' . $clave] = $valor;
    }

    /**
     * Obtiene una variable almacenada en la sesión
     * @param string $clave Nombre de variable
     * @return mixed Variable almacenada
     */
    public static function traer($clave) {
        if (isset($_SESSION[Config::$id . '_' . $clave])) {
            return $_SESSION[Config::$id . '_' . $clave];
        }
        Error::mostrar('Acceso a un índice inexistente en de la sesión', '"' . $clave . '" no existe en la sesión', FALSE);
    }

    /**
     * Elimina una variable almacenada en la sesión
     * @param string $clave Nombre de variable
     */
    public static function quitar($clave) {
        unset($_SESSION[Config::$id . '_' . $clave]);
    }

    /**
     * Obtiene y elimina una variable almacenada en la sesión
     * @param string $clave Nombre de variable
     * @return mixed Variable almacenada
     */
    public static function traerQuitar($clave) {
        $_valor = self::traer($clave);
        self::quitar($clave);
        return $_valor;
    }

    /**
     * Inicia el control de tiempo de sesión
     */
    public static function iniciarTiempo() {
        $_SESSION[Config::$id . '__tiempo'] = time();
    }

    /**
     * Regenera la id de la sesión
     */
    public static function regenerar() {
        session_regenerate_id(TRUE);
    }

    /**
     * Método que maneja el tiempo de sesión
     */
    private static function tiempo() {
        if (isset($_SESSION[Config::$id . '__tiempo'])) {
            if (time() - $_SESSION[Config::$id . '__tiempo'] > Config::$sesion * 60) {
                self::apagar();
                Error::mostrar('Tiempo de sesión expirada', 'El tiempo de sesión ha expirado', FALSE);
            }
            $_SESSION[Config::$id . '__tiempo'] = time();
        }
    }

}
