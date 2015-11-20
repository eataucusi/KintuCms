<?php

/**
 * Archivo index.php
 * 
 * Archivo principal de la parte pública de la aplicación
 * @copyright (c) 2015, KintuCms
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */
try {
    $dir_raiz = realpath(__DIR__ . '/../../') . '/';

    if (!is_readable($dir_raiz . 'core/system/Cnt.php')) {
        throw new Exception('Archivo del sistema no encontrado: core/system/Cnt.php');
    }
    require $dir_raiz . 'core/system/Cnt.php';


    Cnt::fijar($dir_raiz, 'app/admin/', 'admin/');

    if (!is_readable($dir_raiz . 'core/system/Principal.php')) {
        throw new Exception('Archivo del sistema no encontrado: core/system/Principal.php');
    }
    require $dir_raiz . 'core/system/Principal.php';
} catch (Exception $ex) {
    echo $ex->getMessage();
}
