<?php

/**
 * Clase con las propiedades de un Usuario
 * (nombre,apellido,imagen,...etc...) 
 */	
class Usuario
{
	public $id = null;
	public $nombre = '';
	public $apellido = '';
	public $imagen = '';
	public $nick = '';
	public $genero = '';
	public $fecha_nacimiento = '';
	public $ciudad_origen = '';
	public $lugar_recidencia = '';
	public $correo	= '';
	public $sitio_web = '';
	public $facebook = '';
	public $twitter = '';
	public $youtube = '';
	public $contraseña = '';
        public $type = '';
	public $node = null;
        
        public function __construct() {
            
        }
                
}


?>
