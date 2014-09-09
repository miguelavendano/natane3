<?php

require_once('coneccion.php');
require_once('modeloPublicacion.php');
require_once('Publicacion.php');

function creaNodoEvento($titulo,$detalle){

    $minodo = new Publicacion();
    $minodo->nombre = $titulo;
    $minodo->descripcion = $detalle;
    $minodo->fecha_evento = date("d")." de ".date("F")." de ".date("Y");
    $minodo->hora_evento = date("H:i");
    $minodo->fecha = date("d")." de ".date("F")." de ".date("Y")." a la(s) ".date("H:i");
    $minodo->type = 'Evento';
    
    ModelPublicacion::crearNodoEvento($minodo);  
    
}
    
?>

