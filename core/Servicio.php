<?php

/**
 * Clase con las propiedades de un Servicio
 * (nombre,descripcion,tipo,...etc...) 
 */	
class Servicio{
    
	public $id = null;
	public $nombre = '';
	public $descripcion = '';
        public $imagen = '';
        public $type = '';        
	public $node = null;
        
        public function __construct() {
            
        }
}


?>
