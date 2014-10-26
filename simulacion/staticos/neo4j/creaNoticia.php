<?php

require_once('../../../core/coneccion.php');
require_once('../../../core/modeloPublicacion.php');
require_once('../../../core/Publicacion.php');

function creaNodoExperiencia($titulo,$detalle){
    
    $minodo = new Publicacion();
    $minodo->nombre = $titulo;
    $minodo->descripcion = $detalle;
    $minodo->fecha = date("d")." de ".date("F")." de ".date("Y")." a la(s) ".date("H:i");
    $minodo->type = 'Noticia';
    
    ModelPublicacion::crearNodoNoticia($minodo);
    
}
    
?>

