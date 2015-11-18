<?php

/**
 * Archivo ccore/system/Ruteo.php
 * 
 * @copyright (c) 2015, KintuCms
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/**
 * Analiza y ejecuta una url o petición
 * 
 * Esta clase proporciona atributos y métodos que ayudan a recuperar, validar y
 * ejecutar una petición
 */
class Ruteo {

    /**
     * @var Ruteo Instancia de la clase Ruteo
     */
    private static $_instancia;

    /**
     * @var string Controlador de la petición 
     */
    public $contro;

    /**
     * @var string Método de la petición 
     */
    public $metodo;

    /**
     * @var array Parámetros de la petición 
     */
    public $args;

    /**
     * @var string Url saneado de la petición 
     */
    public static $url;

    /**
     * Constructor privado para que esa clase no pueda ser instanciado
     */
    private function __construct() {
        $this->segmentar(filter_input(INPUT_GET, 'url'));
    }

    /**
     * Crea una única instancia de la clase Ruteo
     * 
     * Método que verifica si existe una instancia de esta clase, si existe
     * retorna esa instancia caso contrario crea una instancia
     * @return Ruteo Instancia de la clase Ruteo
     */
    public static function getInstancia() {
        if (!self::$_instancia) {
            self::$_instancia = new self();
        }
        return self::$_instancia;
    }

    /**
     * Extrae partes de una url
     * 
     * Método que divide y extrae partes de una url, si no existe argumento,
     * método y controlador, se les asigna un arreglo vacío, metodo index y
     * controlador index respectivamente,  una url es de la forma
     * controlador/método/arg1/arg2/…
     * @param string $url Url a segmentar
     */
    private function segmentar($url) {
        self::$url = filter_var($url, FILTER_SANITIZE_URL);
        if (self::$url) {
            $_aux = array_filter(explode('/', self::$url));
            $this->contro = strtolower(array_shift($_aux));
            $this->metodo = strtolower(array_shift($_aux));
            $this->args = $_aux;
            if (empty($this->metodo)) {
                $this->metodo = 'index';
            }
        } else {
            $this->contro = 'index';
            $this->metodo = 'index';
            $this->args = array();
        }
    }

    /**
     * Comprueba si la url actual es un alias
     * 
     * Método que verifica si el controlador actual está en la lista de urls
     * cortas, si es así se segmenta la url correspondiente a este alias
     */
    private function buscarAlias() {
        if (key_exists($this->contro, Config::$rutas)) {
            $this->segmentar(Config::$rutas[$this->contro]);
        }
    }

    /**
     * Ejecuta el método de la clase controlador con sus respectivos argumentos
     * 
     * Método que verifica si el controlador, método y argumentos son válidos,
     * y lo ejecuta, de no ser así llama al gestor de errores
     */
    public function resolver() {
        $this->buscarAlias();
        $_ruta = Cnt::$dir_ejec . 'Controladores/' . $this->contro . '.php';
        if (!is_readable($_ruta)) {
            Error::mostrar('Archivo de controlador no existe', 'El archivo ' . $_ruta . ' no existe');
        }
        require_once $_ruta;
        $_clase = $this->contro . 'Ctld';
        if (!class_exists($_clase, FALSE)) {
            Error::mostrar('Controlador ' . $_clase . ' no definido', 'Clase no definida en ' . $_ruta);
        }
        $_contro = $_clase::getInstancia();
        if (!method_exists($_contro, $this->metodo)) {
            Error::mostrar('Método ' . $this->metodo . ' no encontrado', 'Método no existe en ' . $_ruta);
        }
        Cnt::$dir_vista = Cnt::$dir_ejec . 'Vistas/';
        call_user_func_array(array($_contro, $this->metodo), $this->args);
    }

    /**
     * Ejecuta el método mostrar del controlador error
     * 
     * Método que verifica si el controlador, método y argumentos del core son
     * válidos, y lo ejecuta, de no ser así se termina la ejecución
     * @param string $mensaje Mensaje corto
     * @param string $detalle Mensaje detallado
     */
    public function error($mensaje, $detalle) {
        $_ruta = Cnt::$dir_raiz . 'core/Controladores/error.php';
        if (!is_readable($_ruta)) {
            throw new Exception('Archivo del sistema no encontrado: core/Controladores/error.php');
        }
        require $_ruta;
        if (!class_exists('errorCtld')) {
            throw new Exception('Clase errorCtld no encontrado: core/Controladores/error.php');
        }
        $_contro = errorCtld::getInstancia();
        if (!method_exists($_contro, 'mostrar')) {
            throw new Exception('Método mostrar no encontrado: core/Controladores/error.php');
        }
        Cnt::$dir_vista = Cnt::$dir_raiz . 'core/Vistas/';
        $_contro->mostrar($mensaje, $detalle);
        exit(0);
    }

}
