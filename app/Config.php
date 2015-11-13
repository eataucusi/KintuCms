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
     * -------------------------------------------------------------------------
     * Configuración de la aplicación
     * -------------------------------------------------------------------------
     */

    /**
     * @var string Url a través del cual se accede a la aplicación, ejemplo
     * http://dominio.com/
     */
    public $url = 'http://localhost/kintucms/';

    /**
     * @var string Título de la aplicación
     */
    public $titulo = 'Sistema Gestor de Contenidos KintuCms';

    /**
     * @var string Dominio de la aplicación, ejemplo www.tusitio.com
     */
    public $dominio = 'Www.KintuCms.Org';

    /**
     * @var string Meta descripción de la aplicación
     */
    public $meta = 'Descripcion';

    /**
     * @var string Mensaje de error para recursos inexistentes
     */
    public $error = 'Lo sentimos pero la página que buscas no existe o ya no se encuentra aquí.';

    /**
     * @var integer Número de registros por página
     */
    public $registros = 10;

    /**
     * @var string Cadena obtenida aleatoriamente para la generación de
     * contraseñas y otros datos de seguridad
     */
    public $hash = '3215478y';

    /**
     * @var string Identificador de la aplicación, para tener varios proyectos
     * KintuCms en un servidor, no mayor de 3 caracteres 
     */
    public $id = 'jkl';

    /**
     * @var bool La aplicación ¿está en producción?, muestra u oculta los
     * errores de php, si es FALSE muestra errores
     */
    public $produccion = FALSE;

    /**
     * -------------------------------------------------------------------------
     * Configuración del acceso a base de datos MySQL
     * -------------------------------------------------------------------------
     */

    /**
     * @var string Servidor de la base de datos MySQL, generalmente localhost
     */
    public $host_bd = 'localhost';

    /**
     * @var string Nombre de usuario de la base de datos MySQL 
     */
    public $user_bd = 'roo';

    /**
     * @var string Contraseña del usuario de la base de datos MySQL 
     */
    public $pass_bd = '';

    /**
     * @var string Nombre de la base de datos MySQL 
     */
    public $name_bd = '';

    /**
     * -------------------------------------------------------------------------
     * Rutas
     * -------------------------------------------------------------------------
     */

    /**
     * @var array Apodos o nombres cortos para direcciones públicas dentro de
     * la aplicación 
     */
    public $rutas = array(
        'nosotros' => 'articulo/ver/nosotros',
        'acerca' => 'articulo/ver/acerca',
        'contacto' => 'articulo/ver/contacto'
    );

    /**
     * @var Config Instancia de la clase Config
     */
    private static $_instancia;

    /**
     * 
     */
    private function __construct() {
        
    }

    /**
     * Crea una única instancia de la clase Config
     * 
     * Método que verifica si existe una instancia de esta clase, si existe
     * retorna esa instancia caso contrario crea una instancia
     * @return Config Instancia de la clase Config
     */
    public static function getInstancia() {
        if (!self::$_instancia) {
            self::$_instancia = new self();
        }
        return self::$_instancia;
    }

}
