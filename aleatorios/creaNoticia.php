<?php

require_once('coneccion.php');
require_once('modeloPublicacion.php');
require_once('Publicacion.php');

function creaNodoExperiencia($titulo,$detalle){
    
    $minodo = new Publicacion();
    $minodo->nombre = $titulo;
    $minodo->descripcion = $detalle;
    $minodo->fecha = date("d")." de ".date("F")." de ".date("Y")." a la(s) ".date("H:i");
    $minodo->type = 'Noticia';
    
    ModelPublicacion::crearNodoNoticia($minodo);
    
}
    
?>

