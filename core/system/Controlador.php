<?php

abstract class Controlador {

    /**
     * @var Vista Gestor de vistas 
     */
    protected $vista;

    abstract public function index();

    protected function has($accion) {
        echo 'has ' . $accion;
    }

}
