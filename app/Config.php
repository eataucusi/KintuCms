<?php

/**
 * Archivo app/Config.php
 * 
 * @copyright (c) 2015, KintuCms
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/**
 * 
 */
class Config {
    /**
     * Configuración de la aplicación
     */

    /**
     * @var string Url a través del cual se accede a la aplicación, ejemplo
     * http://dominio.com/
     */
    public static $url = 'http://localhost/kintucms/';

    /**
     * @var string Título de la aplicación
     */
    public static $titulo = 'Sistema Gestor de Contenidos KintuCms';

    /**
     * @var string Dominio de la aplicación, ejemplo www.tusitio.com
     */
    public static $dominio = 'Www.KintuCms.Org';

    /**
     * @var string Meta descripción de la aplicación
     */
    public static $meta = 'Descripcion';

    /**
     * @var string Mensaje de error para recursos inexistentes
     */
    public static $error = 'Lo sentimos pero la página que buscas no existe o ya no se encuentra aquí.';

    /**
     * @var integer Número de registros por página
     */
    public static $registros = 10;

    /**
     * @var string Cadena obtenida aleatoriamente para la generación de
     * contraseñas y otros datos de seguridad
     */
    public static $hash = '3215478y';

    /**
     * @var string Identificador de la aplicación, para tener varios proyectos
     * KintuCms en un servidor, no mayor de 3 caracteres 
     */
    public static $id = 'jkl';

    /**
     * @var bool La aplicación ¿está en producción?, muestra u oculta los
     * errores de php, si es FALSE muestra errores
     */
    public static $produccion = FALSE;

    /**
     * Configuración del acceso a base de datos MySQL
     */

    /**
     * @var string Servidor de la base de datos MySQL, generalmente localhost
     */
    public static $host_bd = '';

    /**
     * @var string Nombre de usuario de la base de datos MySQL 
     */
    public static $user_bd = '';

    /**
     * @var string Contraseña del usuario de la base de datos MySQL 
     */
    public static $pass_bd = '';

    /**
     * @var string Nombre de la base de datos MySQL 
     */
    public static $name_bd = '';
    public static $section = array('home', 'about', 'contact', 'more');

}
