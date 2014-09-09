<?php

require_once('coneccion.php');
require_once('modeloServicio.php');
require_once('Servicio.php');

function creaNodoServicio($nom,$desc){

    $minodo = new Servicio();
    $minodo->nombre = $nom;
    $minodo->descripcion = $desc;
    $minodo->type = 'Servicio'; 

    ModelServicio::crearNodoServicio($nodo_servicio);
    
}
    
?>
