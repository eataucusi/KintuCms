<?php

/**
 * Archivo app/Controladores/index.php
 * 
 * @copyright (c) 2015, KintuCms
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/**
 * Controlador principal
 */
class indexCtld extends Controlador {

    /**
     * @var indexCtld Instancia de la clase
     */
    protected static $_instancia;

    /**
     * Constructor privado
     */
    private function __construct() {
        $this->vista = Vista::getInstancia();
    }

    /**
     * Crea una única instancia de la clase
     * @return indexCtld Instancia de la clase
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
        $this->vista->generar('index');
    }

}
