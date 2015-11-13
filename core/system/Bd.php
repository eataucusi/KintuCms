<?php

/**
 * Archivo core/system/Bd.php
 * 
 * @copyright (c) 2015, KintuCms
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ CC BY-NC-SA 4.0
 */

/**
 * Gestiona las conexiones a base de datos MySQL
 * 
 * Esta clase proporciona atributos y métodos que ayudan a recuperar
 * información de las conexiones y resultados de las consultas a base de datos
 * MySQL, esta clase esta implementada con el patrón de diseño singleton
 */
class Bd {

    /**
     * @var Bd Instancia de la clase Bd
     */
    private static $_instancia;

    /**
     * @var array Parámetros de la consulta
     */
    private $_params;

    /**
     * @var string Consulta SQL 
     */
    private $_sql;

    /**
     * @var mysqli Extensión que permite acceder a la funcionalidad de MySQL
     */
    private $_mysqli;

    /**
     * @var mysqli_result Resultados obtenidos a partir de una consulta
     */
    private $_result;

    /**
     * Constructor de la clase Bd
     * 
     * Método que intenta crear una instancia de mysqli y establece el juego de
     * caracteres UTF-8, en caso de error invoca al gestor de errores 
     */
    private function __construct() {
        $this->_mysqli = new mysqli(Config::$host_bd, Config::$user_bd, Config::$pass_bd, Config::$name_bd);
        if (!$this->_mysqli->connect_error) {
            $this->_mysqli->set_charset('utf8');
        } else {
            Error::mysql($this->_mysqli->connect_errno, $this->_mysqli->connect_error);
        }
    }

    /**
     * Crea una única instancia de la clase Bd
     * 
     * Método que verifica si existe una instancia de esta clase, si existe
     * retorna esa instancia caso contrario crea una instancia
     * @return Bd Instancia de la clase Bd
     */
    public static function getIntancia() {
        if (!self::$_instancia) {
            self::$_instancia = new self();
        }
        return self::$_instancia;
    }

    /**
     * Verifica datos de conexión a base de datos
     * 
     * Método que intenta crear una instancia de mysqli
     * @param string $servidor Servidor de la base de datos MySQL
     * @param string $usuaio Nombre de usuario de la base de datos
     * @param string $clave Contraseña del usuario de la base de datos
     * @param string $nombre_bd Nombre de la base de datos
     * @return boolean TRUE en caso de éxito y FALSE caso contrario 
     */
    public static function test($servidor, $usuaio, $clave, $nombre_bd) {
        $_cn = new mysqli($servidor, $usuaio, $clave, $nombre_bd);
        if ($_cn->errno) {
            return FALSE;
        }
        return TRUE;
    }

    public function getSacalar($sql, $parametros = array()) {
        $this->_query($sql . ' LIMIT 1', $parametros);
        return $this->_fetchRow();
    }

    public function getFila($sql, $parametros = array()) {
        $this->_query($sql . ' LIMIT 1', $parametros);
        return $this->_fetchArray();
    }

    public function getArray($sql, $parametros = array()) {
        $this->_query($sql, $parametros);
        return $this->_fetchArray();
    }

    private function _query($sql, $parametros) {
        if (!is_array($parametros)) {
            $parametros = array($parametros);
        }
        $_nsigno = substr_count($sql, '?');
        $_nparam = count($parametros);
        if ($_nparam != $_nsigno) {
            Error::mysql('', 'Cantidad de signos ? (' . $_nsigno . '), no coincide con cantidad de parametros(' . $_nparam . ')' . nl2br("\n") . $sql);
            exit(0);
        }
        $this->_prepare($sql, $parametros);
        $this->_result = $this->_mysqli->query($this->_sql);
        if ($this->_mysqli->error) {
            Error::mysql($this->_mysqli->errno, $this->_sql . nl2br("\n") . $this->_mysqli->error);
        }
    }

    private function _fetchRow() {
        $row = $this->_result->fetch_row();
        $this->_result->free();
        return $row[0];
    }

    private function _fetchArray() {
        $rows = array();
        while ($row = $this->_result->fetch_array(MYSQL_ASSOC)) {
            $rows[] = $row;
        }
        $this->_result->free();
        return $rows;
    }

    private function _prepare($sql, $parametros) {
        for ($i = 0; $i < count($parametros); $i++) {
            if (is_bool($parametros[$i])) {
                $parametros[$i] = $parametros[$i] ? 1 : 0;
            } elseif (is_double($parametros[$i])) {
                $parametros[$i] = str_replace(',', '.', $parametros[$i]);
            } elseif (is_numeric($parametros[$i])) {
                
            } elseif (is_null($parametros[$i])) {
                $parametros[$i] = 'NULL';
            } else {
                $parametros[$i] = "'" . $this->_mysqli->real_escape_string($parametros[$i]) . "'";
            }
        }
        $this->_parametros = $parametros;
        $this->_sql = preg_replace_callback("/(\?)/i", array($this, '_reemplazar'), $sql);
    }

    private function _reemplazar() {
        $actual = current($this->_parametros);
        next($this->_parametros);
        return $actual;
    }

}
