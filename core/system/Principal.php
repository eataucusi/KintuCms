<?php

/**
 * Archivo Principal.php
 * 
 * Archivo que incluye a todos los archivos del sistema 
 * @copyright (c) 2015, KintuCms
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */
if (!is_readable(Cnt::$dir_raiz . 'core/system/Bd.php')) {
    throw new Exception('Archivo del sistema no encontrado: core/system/Bd.php');
}
/**
 * Inclusión para acceso a base de datos
 */
require Cnt::$dir_raiz . 'core/system/Bd.php';

if (!is_readable(Cnt::$dir_raiz . 'core/system/Controlador.php')) {
    throw new Exception('Archivo del sistema no encontrado: core/system/Controlador.php');
}
/**
 * Inclusión del controlador
 */
require Cnt::$dir_raiz . 'core/system/Controlador.php';

if (!is_readable(Cnt::$dir_raiz . 'core/system/Error.php')) {
    throw new Exception('Archivo del sistema no encontrado: core/system/Error.php');
}
/**
 * Inclusión del administrador de errores
 */
require Cnt::$dir_raiz . 'core/system/Error.php';

if (!is_readable(Cnt::$dir_raiz . 'core/system/Input.php')) {
    throw new Exception('Archivo del sistema no encontrado: core/system/Input.php');
}
/**
 * Inclusión del manejador de recepción de datos
 */
require Cnt::$dir_raiz . 'core/system/Input.php';

if (!is_readable(Cnt::$dir_raiz . 'core/system/Modelo.php')) {
    throw new Exception('Archivo del sistema no encontrado: core/system/Modelo.php');
}
/**
 * Inclusión del modelo
 */
require Cnt::$dir_raiz . 'core/system/Modelo.php';

if (!is_readable(Cnt::$dir_raiz . 'core/system/Porcion.php')) {
    throw new Exception('Archivo del sistema no encontrado: core/system/Porcion.php');
}
/**
 * Inclusión de manejador de fragmentos de las regiones
 */
require Cnt::$dir_raiz . 'core/system/Porcion.php';

if (!is_readable(Cnt::$dir_raiz . 'core/system/Ruteo.php')) {
    throw new Exception('Archivo del sistema no encontrado: core/system/Ruteo.php');
}
/**
 * Inclusión de manejador de rutas
 */
require Cnt::$dir_raiz . 'core/system/Ruteo.php';

if (!is_readable(Cnt::$dir_raiz . 'core/system/Sesion.php')) {
    throw new Exception('Archivo del sistema no encontrado: core/system/Sesion.php');
}
/**
 * Inclusión de manejador de sesiones
 */
require Cnt::$dir_raiz . 'core/system/Sesion.php';

if (!is_readable(Cnt::$dir_raiz . 'core/system/Vista.php')) {
    throw new Exception('Archivo del sistema no encontrado: core/system/Vista.php');
}
/**
 * Inclusión de manejador de sesiones
 */
require Cnt::$dir_raiz . 'core/system/Vista.php';

if (!is_readable(Cnt::$dir_raiz . 'app/Config.php')) {
    throw new Exception('Archivo del sistema no encontrado: app/Config.php');
}
/**
 * Inclusión de configuraciones
 */
require Cnt::$dir_raiz . 'app/Config.php';

/**
 * Si no estamos en producción mostramos errores
 */
if (!Config::$produccion) {
    ini_set('error_reporting', E_ALL | E_NOTICE | E_STRICT);
    ini_set('display_errors', '1');
} else {
    ini_set('display_errors', '0');
}

/**
 * Ejecuta la aplicación
 */
$ruteo = Ruteo::getInstancia();
$ruteo->resolver();



