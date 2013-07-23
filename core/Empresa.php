<?php

/**
 * Clase con las propiedades de una Empresa 
 * (nombre,imagen,nit,...etc...) 
 */	
class Empresa
{
	public $id = null;
	public $nombre = '';
	public $imagen = '';
	public $nit = '';
	public $descripcion = '';
	public $ciudad = '';
	public $telefono = '';
	public $direccion = '';
	public $latitud	= '';
	public $longitud = '';
	public $correo = '';	
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
