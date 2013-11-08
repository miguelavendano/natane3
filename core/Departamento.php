<?php

/**
 * Clase con las propiedades de un Departamento
 * (nombre,imagen,latitud,longitud) 
 */
class Departamento{
    
	public $id = null;
	public $nombre = '';
	public $imagen = '';
	public $latitud = '';
	public $longitud = '';
        public $type = '';
	public $node = null;
        
        public function __construct() {
            
        }                
}


?>
