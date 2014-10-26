<?php

require_once('../../../core/coneccion.php');
require_once('../../../core/modeloServicio.php');
require_once('../../../core/Servicio.php');

function creaNodoServicio($desc){

    $minodo = new Servicio();
    $minodo->nombre = 'Recorridos Turisticos';
    $minodo->imagen = 'imagen ('.  rand(1, 999).').jpg';
    $minodo->descripcion = $desc;
    $minodo->type = 'Servicio'; 

    ModelServicio::crearNodoServicio($minodo);
    
}
    
?>
