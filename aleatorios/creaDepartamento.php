<?php

require_once('coneccion.php');
require_once ('Departamento.php');
require_once ('modeloDepartamento.php');

function creaNodoDepartamento($nom,$img){
   
    $minodo = new Departamento();
    $minodo->nombre = $nom;
    $minodo->imagen = $img;
    $minodo->latitud='4.15';
    $minodo->longitud='-73.64';    
    $minodo->type = 'Departamento';            
    
    ModelDepartamento::crearNodoDepartamento($minodo);
    
}
    
?>

