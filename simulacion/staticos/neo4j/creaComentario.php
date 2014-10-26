<?php

require_once('../../../core/coneccion.php');
require_once('../../../core/modeloComentario.php');
require_once('../../../core/Comentario.php');

function creaNodoComentario($comentario){
    
    $minodo = new Comentario();
    $minodo->usuario = '';
    $minodo->detalle = $comentario;
    $minodo->fecha = date("d")." de ".date("F")." de ".date("Y")." a la(s) ".date("H:i");
    $minodo->nombre = "";
    $minodo->type = 'Comentario';
  
    ModelComentario::crearNodoComentario($minodo);
}    
    

    
?>

