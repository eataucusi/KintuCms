<?php

class indexMdl extends Modelo {

    /**
     * @var indexMdl Instancia de la clase indexMdl
     */
    protected static $_instancia;

    /**
     * Constructor
     */
    private function __construct() {
        $this->bd = Bd::getIntancia();
    }

    /**
     * Crea una única instancia de la clase indexMdl
     * 
     * Método que verifica si existe una instancia de esta clase, si existe
     * retorna esa instancia, caso contrario crea una instancia
     * @return indexMdl Instancia de la clase indexMdl
     */
    public static function getInstancia() {
        if (!self::$_instancia) {
            self::$_instancia = new self();
        }
        return self::$_instancia;
    }
    
    

}
