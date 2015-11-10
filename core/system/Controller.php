<?php

abstract class Controller {

    /**
     * @var View Gestor de vistas 
     */
    protected $view;

    public function __construct() {
        $this->view = new View();
    }

    abstract public function index();
}
