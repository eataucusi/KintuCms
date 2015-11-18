<?php

class Porcion {

    public function __construct() {
        
    }

    public function getHtml($llamable) {
        $_aux = array_filter(explode('/', $llamable));
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
