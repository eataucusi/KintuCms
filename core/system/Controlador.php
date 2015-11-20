<?php

/**
 * Archivo core/system/Controlador.php
 * 
 * @copyright (c) 2015, KintuCms
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/**
 * Controlador de la aplicación
 * 
 * Esta clase proporciona atributos y métodos que heredarán los controladores
 */
abstract class Controlador {

    /**
     * @var Vista Gestor de vistas 
     */
    protected $vista;

    /**
     * Es obligatorio que todos  los controladores tengan el método index
     */
    abstract public function index();

    /**
     * Redirige a una ruta y si es necesario a un hash tag
     * @param string $ruta Ruta a donde redirigir
     * @param string $hash Hash tag
     */
    protected function redirigir($ruta = '', $hash = '') {
        header('location: ' . Config::$url . $ruta . $hash);
        exit(0);
    }

    /**
     * Importa una librería ubicada en la carpeta libs
     * 
     * El nombre o ruta de la librería debe ir sin extensión
     * @param string $libreria Nombre o ruta de la librería
     */
    protected function getLib($libreria) {
        $_ruta = Cnt::$dir_raiz . 'libs/' . $libreria . '.php';
        if (!is_readable($_ruta)) {
            Error::mostrar('Librería "' . $libreria . '" no encontrada', 'Archivo no existe ' . $_ruta);
        }
        require $_ruta;
    }

    /**
     * Importa y retorna una instancia de un modelo, el modelo va sin extensión 
     * 
     * @param string $modelo Nombre del Modelo 
     * @param bool $es_admin Bandera si el modelo está en la carpeta admin
     * @return Modelo Instnacia del modelo
     */
    protected function getModelo($modelo, $es_admin = FALSE) {
        if ($es_admin) {
            $_ruta = Cnt::$dir_raiz . 'app/admin/Modelos/' . $modelo . '.php';
            $modelo = $modelo . 'MdlAdm';
        } else {
            $_ruta = Cnt::$dir_raiz . 'app/Modelos/' . $modelo . '.php';
            $modelo = $modelo . 'Mdl';
        }
        if (!is_readable($_ruta)) {
            Error::mostrar('Archivo de modelo "' . $modelo . '" no encontrado', $_ruta . ' no existe');
        }
        require_once $_ruta;
        if (!class_exists($modelo)) {
            Error::mostrar('Modelo "' . $modelo . '" no definido', 'Clase no definida en ' . $_ruta);
        }
        return $modelo::getInstancia();
    }

}
