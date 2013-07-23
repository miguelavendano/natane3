<?php

/**
 * Clase con las propiedades de un Sitio 
 * (nombre,imagen,tipo,...etc...) 
 */	
class Sitio
{
	public $id = null;
	public $nombre = '';
	public $imagen = '';
	public $tipo_sitio = '';
	public $descripcion = '';
        public $ciudad = '';
	public $telefono = '';
	public $direccion = '';
	public $correo = '';
	public $latitud	= '';
	public $longitud = '';
	public $facebook = '';
	public $twitter = '';
	public $youtube = '';
        public $type = '';
        
	public $node = null;
        
        public function __construct() {
            
        }
       
        
          
}
?>
