<?php

class indexCtld extends Controlador {

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
        $this->getLib('hola');
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

    public function pagina() {

        $this->vista->setPorcion('index/header', 'reg_cabeza');
        $this->vista->setPorcion('index/pie', 'reg_pie');
        $this->vista->setPorcion('saludo/derechos/ediar', 'reg_pie');
        $this->vista->setPorcion('index/menu', 'reg_menu');
        $this->vista->generar('index/pagina');
    }

}
