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

if (!is_readable(KC_RAIZ . 'core/system/Uri.php')) {
    die('Archivo del sistema no encontrado: core/system/Uri.php');
}
require_once KC_RAIZ . 'core/system/Uri.php';

if (!is_readable(KC_RAIZ . 'core/system/Controlador.php')) {
    die('Archivo del sistema no encontrado: core/system/Controlador.php');
}
require_once KC_RAIZ . 'core/system/Controlador.php';

if (!is_readable(KC_RAIZ . 'core/system/Vista.php')) {
    die('Archivo del sistema no encontrado: core/system/Vista.php');
}
require_once KC_RAIZ . 'core/system/Vista.php';

if (!is_readable(KC_RAIZ . 'core/system/Bd.php')) {
    die('Archivo del sistema no encontrado: core/system/Bd.php');
}
require_once KC_RAIZ . 'core/system/Bd.php';

if (!is_readable(KC_RAIZ . 'core/system/Error.php')) {
    die('Archivo del sistema no encontrado: core/system/Error.php');
}
require_once KC_RAIZ . 'core/system/Error.php';

if (!is_readable(KC_RAIZ . 'core/system/Input.php')) {
    die('Archivo del sistema no encontrado: core/system/Input.php');
}
require_once KC_RAIZ . 'core/system/Input.php';

if (!is_readable(KC_RAIZ . 'app/Config.php')) {
    die('Archivo del sistema no encontrado: app/Config.php');
}
require_once KC_RAIZ . 'app/Config.php';

if (!is_readable(KC_RAIZ . 'core/system/Ruteo.php')) {
    die('Archivo del sistema no encontrado: core/system/Ruteo.php');
}
require_once KC_RAIZ . 'core/system/Ruteo.php';

$cnf = Config::getInstancia();

if (!$cnf->produccion) {
    ini_set('error_reporting', E_ALL | E_NOTICE | E_STRICT);
    ini_set('display_errors', '1');
    ini_set('track_errors', 'On');
} else {
    ini_set('display_errors', '0');
}


//$objLanz = Lanzador::getInstancia();
//$objLanz->resolver();

$i = Input::getInstancia();

echo '<pre>';
print_r($i->copia);
echo '</pre>';
if (isset($i->copia['post'])) {
    var_dump($i->evaluaTexto('nombre', 'post', array(1,0)));
}
?>
<form method="post">
    <input type="text" name="nombre" ><br>
    <input type="submit" value="Enviar">
    <textarea><?php echo $i->limpio['post']['nombre'] ?></textarea>
    <code><?php echo var_dump($i->limpio['post']['nombre']) ?></code>

</form>

