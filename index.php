<?php

try {
    $dir_raiz = realpath(__DIR__) . '/';

    if (!is_readable($dir_raiz . 'core/system/Cnt.php')) {
        throw new Exception('Archivo del sistema no encontrado: core/system/Cnt.php');
    }
    require $dir_raiz . 'core/system/Cnt.php';


    Cnt::fijar($dir_raiz, 'app/');

    if (!is_readable($dir_raiz . 'core/system/Principal.php')) {
        throw new Exception('Archivo del sistema no encontrado: core/system/Principal.php');
    }
    require $dir_raiz . 'core/system/Principal.php';
} catch (Exception $ex) {
    echo $ex->getMessage();
}
