<?php

/**
 * Archivo Sesion.php
 * 
 * Este archivo define la clase Sesion.
 * 
 * @license http://licencia licencia
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @version 1.0 13/06/2015 21:48:00 
 */

/**
 * Clase Sesion
 * 
 * Esta clase maneja las sesiones de la aplicación.
 */
class Sesion {

    /**
     * Metodo que inicia una Sesion
     */
    public static function iniciar() {
        session_start();
        self::tiempo();
    }

    /**
     * Metodo que elimina una variable de sesion o elimina la sesion
     * @param string $clave variable de sesion
     */
    public static function matar($clave = FALSE) {
        if ($clave) {
            unset($_SESSION[ID_APP . '_' . $clave]);
        } else {
            unset($_SESSION);
            session_destroy();
        }
    }

    /**
     * Metodo que guarda una variable en la sesion
     * @param type $clave
     * @param type $valor
     */
    public static function set($clave, $valor) {
        if (!empty(ID_APP . '_' . $clave)) {
            $_SESSION[ID_APP . '_' . $clave] = $valor;
        }
    }

    /**
     * Metodo que obtiene una variable almacenada en la sesion
     * @param type $clave
     * @return string
     */
    public static function get($clave) {
        if (isset($_SESSION[ID_APP . '_' . $clave])) {
            return $_SESSION[ID_APP . '_' . $clave];
        }
        return '';
    }

    /**
     * Método que regenera la sesion
     */
    public static function regenerar() {
        session_regenerate_id(TRUE);
    }

    /**
     * Método que maneja el tiempo de sesion
     */
    public static function tiempo() {
        if (Sesion::get(ID_APP . '_logueado')) {
            if (time() - Sesion::get(ID_APP . '_tiempo') > (TIEMPO_SESION * 60)) {
                Sesion::matar();
                header('location: ' . URL_BASE . 'traspie/acceso/403');
                exit(0);
            }
            Sesion::set(ID_APP . '_tiempo', time());
        }
    }

}
