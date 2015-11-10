<?php

/**
 * Archivo Bd.php
 * 
 * Este archivo define la clase Bd.
 * 
 * @license http://licencia licencia
 * @author Edison Ataucusi R. <eataucusi@gmail.com>
 * @version 1.0 19/06/2015 21:48:00 
 */

/**
 * Clase Bd
 * 
 * Gestiona el acceso a base de datos MySQL, utiliza el patrÃ³n singleton
 */
class Db {

    /**
     * Ãšnica instancia de esta clase.
     * @var Bd 
     */
    private static $_instancia;

    /**
     * Arreglo con parÃ¡metros de una consulta.
     * @var array() 
     */
    private $_parametros;

    /**
     * InstrucciÃ³n SQL a ejecutar
     * @var string
     */
    private $_sql;

    /**
     * Conector a un servidor de bases de datos MySQL.
     * @var mysqli 
     */
    private $_mysqli;

    /**
     * Resultados de luna consulta a MySQL.
     * @var mysqli_result 
     */
    private $_result;

    private function __construct($servidor, $usuaio, $clave, $nombre_bd) {
        $this->_mysqli = new mysqli($servidor, $usuaio, $clave, $nombre_bd);
        if (!$this->_mysqli->connect_error) {
            $this->_mysqli->set_charset('utf8');
        } else {
            Error::mysql($this->_mysqli->connect_errno, $this->_mysqli->connect_error);
        }
    }

    public static function getIntancia() {
        if (!self::$_instancia) {
            self::$_instancia = new self(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        }
        return self::$_instancia;
    }

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
