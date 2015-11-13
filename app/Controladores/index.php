<?php

class indexCtld extends Controlador {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->vista->generar('index');
    }

    public function Saludo($nombre) {
       echo $nombre;
        
    }

}
