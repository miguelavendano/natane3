<?php

/**
 * Clase con las propiedades de un Administrador
 * (nombre,apellido,imagen,...etc...) 
 */	
class Administrador{
    
	public $id = null;
	public $nombre = '';
	public $apellido = '';
	public $imagen = '';
//	public $genero = '';
//	public $fecha_nacimiento = '';
	public $correo	= '';
	public $password = '';
        public $nick = '';
        public $type = '';
	public $node = null;
        
        public function __construct() {
            
        }                
}


?>
