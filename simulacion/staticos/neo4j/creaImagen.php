<?php

require_once('coneccion.php');
require_once('modeloImagen.php');
require_once('Imagen.php');

function creaNodoImagen($nombre,$descipcion){
  
    $minodo = new Imagen();
    $minodo->nombre = $nombre;
    $minodo->descripcion = $descipcion;  
    $minodo->type = 'Imagen';  
    
    ModelImagen::crearNodoImagen($minodo);
        
}
    
?>

