<?php

/**
 * Clase con las propiedades de una Experiencia
 * (nombre y descripcion) 
 */
class Experiencia{
    
	public $id = null;
	public $nombre = '';
	public $descripcion = '';
        public $id_sitio = '';
        public $nombre_sitio = '';
        public $type = '';
	public $node = null;
        
        public function __construct() {
            
        }
}


?>
