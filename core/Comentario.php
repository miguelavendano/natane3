<?php

/**
 * Clase con las propiedades de un Servicio
 * (nombre,descripcion,tipo,...etc...) 
 */	
class Comentario{
    
	public $id = null;
	public $usuario = '';
	public $detalle = '';        
        public $type = '';        
	public $node = null;
        
        public function __construct() {
            
        }
}


?>