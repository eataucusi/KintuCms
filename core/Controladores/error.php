<?php

class errorCtld extends Controlador {

    protected static $_instancia;

    private function __construct() {
        $this->vista = Vista::getInstancia();
    }

    public static function getInstancia() {
        if (!self::$_instancia) {
            self::$_instancia = new self();
        }
        return self::$_instancia;
    }

    public function index() {
        $this->vista->genParcial('error');
    }

    public function mostrar($mensaje, $detalle) {
        $this->vista->genParcial('error', array('mensaje' => $mensaje, 'detalle' => $detalle));
    }

}
