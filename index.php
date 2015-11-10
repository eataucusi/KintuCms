<?php

/**
 * Archivo index.php
 * 
 * @copyright (c) 2015, KintuCms
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */
/**
 * Directorio raíz de la aplicación
 */
define('KC_RAIZ', realpath(__DIR__) . '/');

/**
 * Directorio de ejecución, puede ser app o admin 
 */
define('KC_EXE', KC_RAIZ . 'app/');

if (!is_readable(KC_RAIZ . 'core/system/Peticion.php')) {
    die('Archivo del sistema no encontrado: core/system/Peticion.php');
}
require_once KC_RAIZ . 'core/system/Peticion.php';

if (!is_readable(KC_RAIZ . 'core/system/Controller.php')) {
    die('Archivo del sistema no encontrado: core/system/Controller.php');
}
require_once KC_RAIZ . 'core/system/Controller.php';

if (!is_readable(KC_RAIZ . 'core/system/Vista.php')) {
    die('Archivo del sistema no encontrado: core/system/Vista.php');
}
require_once KC_RAIZ . 'core/system/Vista.php';

if (!is_readable(KC_RAIZ . 'app/Config.php')) {
    die('Archivo del sistema no encontrado: app/Config.php');
}
require_once KC_RAIZ . 'app/Config.php';

if (!is_readable(KC_RAIZ . 'core/system/Lanzador.php')) {
    die('Archivo del sistema no encontrado: core/system/Lanzador.php');
}
require_once KC_RAIZ . 'core/system/Lanzador.php';

if (!Config::$app_prod) {
    ini_set('error_reporting', E_ALL | E_NOTICE | E_STRICT);
    ini_set('display_errors', '1');
    ini_set('track_errors', 'On');
} else {
    ini_set('display_errors', '0');
}
Route::ejecutar();
