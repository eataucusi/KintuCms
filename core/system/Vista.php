<?php

/**
 * Archivo core/system/Vista.php
 * 
 * @copyright (c) 2015, KintuCms
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/**
 * Analiza y renderiza las vistas
 * 
 * Esta clase proporciona atributos y métodos que ayudan a generar las vistas
 */
class Vista {

    /**
     * @var Vista Instancia de la clase Vista
     */
    private static $_instancia;

    /**
     * @var string Título de la página 
     */
    public $titulo;

    /**
     * @var string Meta descripción de la página
     */
    public $meta;

    /**
     * @var array Arreglo que almacena las regiones de la plantilla  
     */
    private $_region;

    /**
     * @var array Arreglo que almacena los archivos js
     */
    public $js;

    /**
     * Constructor privado para que no pueda ser instanciado
     */
    private function __construct() {
        $this->titulo = Config::$titulo;
        $this->meta = Config::$meta;
        $this->_region = array();
    }

    /**
     * Crea una única instancia de la clase Vista
     * 
     * Método que verifica si existe una instancia de esta clase, si existe
     * retorna esa instancia, caso contrario crea una instancia
     * @return Vista Instancia de la clase Vista
     */
    public static function getInstancia() {
        if (!self::$_instancia) {
            self::$_instancia = new self();
        }
        return self::$_instancia;
    }

    /**
     * Genera la vista completa
     * 
     * Método que genera la vista, incluyendo la plantilla, sus regiones y sus
     * porciones
     * @param string $vista Dirección de la vista
     * @param array $data Datos que se pasan a la vista
     */
    public function generar($vista, $data = array()) {
        for ($i = 0; $i < count(Config::$region); $i++) {
            $region[Config::$region[$i]] = '';
        }
        $por = new Porcion();
        foreach ($this->_region as $reg => $pos) {
            for ($i = 0; $i < count($pos); $i++) {
                $region[$reg] = $region[$reg] . $por->getHtml($pos[$i]);
            }
        }
        $region['reg_cuerpo'] = $this->genRetornar($vista, $data);
        if (Cnt::$sufijo_url != '') {
            require Cnt::$dir_vista . '_plantilla/plantilla.phtml';
        } else {
            require Cnt::$dir_vista . '_plantilla/' . Config::$plantilla . '.phtml';
        }
    }

    /**
     * Genera la vista parcial
     * 
     * Método que genera la vista, sin incluir la plantilla
     * @param string $vista Dirección de la vista
     * @param array $data Datos que se pasan a la vista
     */
    public function genParcial($vista, $data = array()) {
        $_ruta = Cnt::$dir_vista . $vista . '.phtml';
        if (!is_readable($_ruta)) {
            Error::mostrar('Vista "' . $vista . '" no existe', 'No existe el archivo ' . $_ruta);
        }
        extract($data);
        require $_ruta;
    }

    /**
     * Genera una vista parcial y retorna el HTML generado
     * 
     * Método que genera la vista, sin incluir plantilla y retorna el HTML
     * generado
     * @param string $vista Dirección de la vista
     * @param array $data Datos que se pasan a la vista
     * @return string Código HTML que generó la vista
     */
    public function genRetornar($vista, $data = array()) {
        ob_start();
        $this->genParcial($vista, $data);
        $_conte = ob_get_contents();
        ob_get_clean();
        return $_conte;
    }

    /**
     * Asigna una porción a una región de la plantilla
     * 
     * Método que asigna porciones a una región de la plantilla, una porción es
     * una parte pequeña de una página
     * @param string $ruta Ruta que retorna HTML
     * @param string $region Nombre de la región de la vista
     */
    public function setPorcion($ruta, $region) {
        if (array_search($region, Config::$region) === FALSE) {
            Error::mostrar('Región "' . $region . '" no existe', $region . 'no es una región válida');
        }
        $this->_region[$region][] = $ruta;
    }

    public function setJs($ruta, $plantilla = TRUE) {
        if ($plantilla) {
            $_ruta = Cnt::$url_plan . 'js/' . $ruta . '.js';
        } else {
            $_ruta = $ruta . '.js';
        }
        if (!is_readable($_ruta)) {
            Error::mostrar('JavaScript "' . $ruta . '" no existe', 'No existe el archivo ' . $_ruta);
        }
        $this->js[] = $_ruta;
    }

}
