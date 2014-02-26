<?php

/**
 * Clase con las propiedades de una Experiencia
 * (nombre y descripcion) 
 */
class Publicacion{
    
	public $id = null;
	public $nombre = '';
	public $descripcion = '';
        public $imagen = '';
        public $fecha_evento = '';
        public $hora_evento = '';
        public $fecha = '';
        public $type = '';
	public $node = null;
        
        public function __construct() {
            
        }
}


?>
