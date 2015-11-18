<?php

/**
 * Archivo ccore/system/Vista.php
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
        $por = new Porcion();
        $region = array();
        foreach ($this->_region as $reg => $pos) {
            for ($i = 0; $i < count($pos); $i++) {
                if (key_exists($reg, $region)) {
                    $region[$reg] = $region[$reg] . $por->getHtml($pos[$i]);
                } else {
                    $region[$reg] = $por->getHtml($pos[$i]);
                }
            }
        }
        $region['reg_cuerpo'] = $this->genRetornar($vista, $data);
        require_once Cnt::$dir_vista . '_plantilla/plantilla.phtml';
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
            Error::mostrar('No existe esta vista', 'detalle de no existe vista');
        }
        extract($data);
        require_once $_ruta;
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
            Error::mostrar('No existe región ' . $region, 'dte no existe la region');
        }
        $this->_region[$region][] = $ruta;
    }

}
