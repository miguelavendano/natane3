<?php

require_once('../../../core/coneccion.php');
require_once('../../../core/modeloImagen.php');
require_once('../../../core/Imagen.php');

function creaNodoImagen($nombre,$descipcion){
  
    $minodo = new Imagen();
    $minodo->nombre = $nombre;
    $minodo->descripcion = $descipcion;  
    $minodo->type = 'Imagen';  
    
    ModelImagen::crearNodoImagen($minodo);
        
}
    
?>

