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
class Ruteo {

    /**
     * @var Ruteo Instancia de la clase Ruteo
     */
    private static $_instancia;
    private $uri;

    /**
     * 
     */
    private function __construct() {
        $this->uri = Uri::getInstancia();
    }

    /**
     * Crea una única instancia de la clase Ruteo
     * 
     * Método que verifica si existe una instancia de esta clase, si existe
     * retorna esa instancia caso contrario crea una instancia
     * @return Ruteo Instancia de la clase Ruteo
     */
    public static function getInstancia() {
        if (!self::$_instancia) {
            self::$_instancia = new self();
        }
        return self::$_instancia;
    }

    public function resolver() {
        $this->uri->segmentar();
        $_ruta = KC_EXE . 'Controladores/' . $this->uri->contro . '.php';
        if (!is_readable($_ruta)) {
            $this->error('k', 'l');
        }
        require_once $_ruta;
        $_clase = $this->uri->contro . 'Ctld';
        if (!class_exists($_clase, FALSE)) {
            $this->error('k', 'm');
        }
        $_contro = new $_clase();
        if (!is_callable(array($_contro, $this->uri->metodo))) {
            $this->error('j', 'k');
        }
        define('KC_VISTA', KC_EXE . 'Vistas/');
        call_user_func_array(array($_contro, $this->uri->metodo), $this->uri->args);
    }

    public function error($mensaje, $detalle) {
        exit();
    }

}
