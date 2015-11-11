<?php

class Vista {

    /**
     * @var string Título de la página 
     */
    public $titulo;

    /**
     * @var string Meta descripción de la página
     */
    public $meta;

    public function __construct() {
        $this->titulo = Config::$titulo;
        $this->meta = Config::$meta;
    }

    public function generar($vista, $data = array()) {
        $ruta = KC_VISTA . $vista . '.phtml';
        if (!is_readable($ruta)) {
            Route::error('Vista ' . $vista . ' no encontrada', 'No existe el archivo ' . $ruta);
        }
        extract($data);
        require_once $ruta;
    }

}
