<?php

abstract class Controlador {

    /**
     * @var Vista Gestor de vistas 
     */
    protected $vista;

    public function __construct() {
        $this->vista = new Vista();
    }

    abstract public function index();
}
