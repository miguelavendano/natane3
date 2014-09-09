<?php

require_once('coneccion.php');
require_once('modeloComentario.php');
require_once('Comentario.php');

function creaNodoComentario($idUsuario,$comentario){
    
    $minodo = new Comentario();
    $minodo->usuario = $idUsuario;
    $minodo->detalle = $comentario;    
    $minodo->fecha = date("d")." de ".date("F")." de ".date("Y")." a la(s) ".date("H:i");
    $minodo->nombre = "";    
    $minodo->type = 'Comentario';      
  
    ModelComentario::crearNodoComentario($minodo);        
}    
    

    
?>

