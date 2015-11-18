<?php

class saludoCtld extends Controlador {

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
        $this->vista->genParcial('index/index');
    }

    public function header() {
        return $this->vista->genRetornar('index/header');
    }

    public function menu() {
        return $this->vista->genRetornar('index/menu');
    }

    public function pie() {

        return $this->vista->genRetornar('index/pie');
    }

    public function derechos($target) {
        return $this->vista->genRetornar('index/derechos', array('target' => $target));
    }

}
