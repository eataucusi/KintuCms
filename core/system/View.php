<?php

class View {

    /**
     * @var string Título de la página 
     */
    public $title;

    /**
     * @var string Meta descripción de la página
     */
    public $meta;

    public function __construct() {
        $this->title = Config::$app_name;
        $this->meta = Config::$app_meta;
    }

    public function render($vista, $data = array()) {
        $ruta = KC_VIEW . $vista . '.phtml';
        if (!is_readable($ruta)) {
            Route::error('Vista ' . $vista . ' no encontrada', 'No existe el archivo ' . $ruta);
        }
        extract($data);
        require_once $ruta;
    }

}
