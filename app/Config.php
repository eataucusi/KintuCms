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
    public static $app_url = 'http://localhost/kintucms/';

    /**
     * @var string Nombre de la aplicación
     */
    public static $app_name = 'Sistema Gestor de Contenidos KintuCms';

    /**
     * @var string Dominio de la aplicación, ejemplo www.tusitio.com
     */
    public static $app_domain = 'Www.KintuCms.Org';

    /**
     * @var string Meta descripción de la aplicación
     */
    public static $app_meta = 'Descripcion';

    /**
     * @var string Meta descripción de la aplicación
     */
    public static $app_error = 'Lo sentimos pero la página que buscas no existe o ya no se encuentra aquí.';

    /**
     * @var integer Número de registros por página
     */
    public static $registros = 10;

    /**
     * @var string Cadena obtenida aleatoriamente para la generación de
     * contraseñas y otros datos de seguridad
     */
    public static $app_hash = '3215478y';

    /**
     * @var string Identificador de la aplicación, para tener varios proyectos
     * KintuCms en un servidor, no mayor de 3 caracteres 
     */
    public static $app_id = 'jkl';

    /**
     * @var bool La aplicación ¿está en producción?, muestra u oculta los
     * errores de php, si es FALSE muestra errores
     */
    public static $app_prod = FALSE;

    /**
     * Configuración del acceso a base de datos MySQL
     */

    /**
     * @var string Servidor de la base de datos MySQL, generalmente localhost
     */
    public static $db_host = '';

    /**
     * @var string Nombre de usuario de la base de datos MySQL 
     */
    public static $db_user = '';

    /**
     * @var string Contraseña del usuario de la base de datos MySQL 
     */
    public static $db_pass = '';

    /**
     * @var string Nombre de la base de datos MySQL 
     */
    public static $db_name = '';

    public static $section = array('home', 'about', 'contact', 'more');
}
