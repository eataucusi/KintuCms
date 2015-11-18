<?php

/**
 * Archivo ccore/system/Porcion.php
 * 
 * @copyright (c) 2015, KintuCms
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/**
 * Analiza rutas y obtiene HTML que genera la ruta
 * 
 * Esta clase proporciona métodos que ayudan a obtener código HTML generado pos
 * las rutas
 */
class Porcion {

    /**
     * Constructor
     */
    public function __construct() {
        
    }

    /**
     * Analiza una ruta y obtiene el código HTML
     * 
     * Método que analiza una ruta, si es válido ejecuta esta ruta y retorna en
     * código HTML generado por la ruta
     * @param string $ruta Ruta que retorna un HTML
     * @return string Código HTML generado por la ruta
     */
    public function getHtml($ruta) {
        $_aux = array_filter(explode('/', $ruta));
        $_contro = strtolower(array_shift($_aux));
        $_metodo = strtolower(array_shift($_aux));
        $_args = $_aux;
        $_ruta = Cnt::$dir_ejec . 'Controladores/' . $_contro . '.php';
        if (!is_readable($_ruta)) {
            Error::mostrar('mnesa', 'deta');
        }
        require_once $_ruta;
        $_clase = $_contro . 'Ctld';
        if (!class_exists($_clase, FALSE)) {
            Error::mostrar('mnesa', 'deta');
        }
        $_ctld = $_clase::getInstancia();
        if (!is_callable(array($_ctld, $_metodo))) {
            Error::mostrar('mnesa', 'deta');
        }
        return call_user_func_array(array($_ctld, $_metodo), $_args);
    }

}
