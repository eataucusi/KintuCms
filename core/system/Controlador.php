<?php

/**
 * Archivo ccore/system/Controlador.php
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
     * @param string $libreria Ruta de la librearía
     */
    protected function getLib($libreria) {
        $_ruta = Cnt::$dir_raiz . 'libs/' . $libreria . '.php';
        if (!is_readable($_ruta)) {
            Error::mostrar('Librería no encontrada', 'Archivo no existe ' . $_ruta);
        }
        require $_ruta;
    }


    protected function getModelo($modelo, $es_admin = FALSE) {
        if ($es_admin) {
            $_ruta = Cnt::$dir_raiz . 'app/admin/Modelos/' . $modelo . '.php';
        } else {
            $_ruta = Cnt::$dir_raiz . 'app/Modelos/' . $modelo . '.php';
        }
        $modelo = $modelo . 'Mdl';
        if (!is_readable($_ruta)) {
            Error::mostrar('Modelo no encontrado', 'Archivo no existe ' . $_ruta);
        }
        require_once $_ruta;
        return new $modelo;
    }

}
