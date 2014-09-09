<?php

require_once('coneccion.php');
require_once 'modeloEmpresa.php';
require_once 'Empresa.php';

function creaNodoEmpresa($nom,$desc,$img,$tel,$dir,$orig,$dir,$mail,$web,$face,$twit,$you,$contra){
    
    $minodo = new Empresa();
    $minodo->nombre = $nom;
    $minodo->imagen = $img;
    $minodo->nit = '900470024-7';    
    $minodo->descripcion = $desc;
    $minodo->ciudad = $orig;
    $minodo->telefono=$tel;
    $minodo->direccion=$dir;
    $minodo->latitud='4.15';
    $minodo->longitud='-73.64';    
    $minodo->correo = $mail;
    $minodo->sitio_web = $web;    
    $minodo->facebook = $face;
    $minodo->twitter = $twit;
    $minodo->youtube = $you;
    $minodo->contraseña = $contra;
    $minodo->type = 'Empresa';
  
    ModelEmpresa::crearNodoEmpresa($minodo);
    
}
    
?>

