<?php

require_once('../../../core/coneccion.php');
require_once('../../../core/modeloExperiencia.php');
require_once('../../../core/Experiencia.php');

function creaNodoExperiencia($nom,$desc){
    
    $minodo = new Experiencia();
    $minodo->nombre = $nom;
    $minodo->descripcion = $desc;
    $minodo->type = 'Experiencia';
  
    ModelExperiencia::crearNodoExperiencia($minodo);
    
}
    
?>

