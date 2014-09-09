<?php

require_once('coneccion.php');
require_once('modeloExperiencia.php');
require_once('Experiencia.php');

function creaNodoExperiencia($nom,$desc){
    
    $minodo = new Experiencia();
    $minodo->nombre = $nom;
    $minodo->descripcion = $desc;
    $minodo->type = 'Experiencia';
  
    ModelExperiencia::crearNodoExperiencia($minodo);
    
}
    
?>

