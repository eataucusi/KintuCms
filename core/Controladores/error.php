<?php

/**
 * Archivo core/Controladores/error.php
 * 
 * @copyright (c) 2015, KintuCms
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/**
 * Muestra los errores de la aplicación
 */
class errorCtld extends Controlador {

    /**
     * @var errorCtld Instancia de la clase errorCtld
     */
    protected static $_instancia;

    /**
     * Constructor privado
     */
    private function __construct() {
        $this->vista = Vista::getInstancia();
    }

    /**
     * Crea una única instancia la clase
     * @return errorCtld Instancia de la clase
     */
    public static function getInstancia() {
        if (!self::$_instancia) {
            self::$_instancia = new self();
        }
        return self::$_instancia;
    }

    /**
     * Método principal
     */
    public function index() {
        $this->vista->genParcial('error');
    }

    /**
     * Muestra un error
     * @param string $mensaje Mensaje de error
     * @param string $detalle Detalle del error
     */
    public function mostrar($mensaje, $detalle) {
        $this->vista->genParcial('error', array('mensaje' => $mensaje, 'detalle' => $detalle));
    }

}
