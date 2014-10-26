<?php

require_once('../../../core/coneccion.php');
require_once('../../../core/modeloEmpresa.php');
require_once('../../../core/Empresa.php');

function creaNodoEmpresa($nom,$desc,$img,$ciudad,$mail){
    
    $minodo = new Empresa();
    $minodo->nombre = $nom;
    $minodo->imagen = $img;
    $minodo->imagen = "imagen1.jpg";
    $minodo->nit = '900470024-7';    
    $minodo->descripcion = $desc;
    $minodo->ciudad = $ciudad;
    $minodo->telefono='327 645 0978';
    $minodo->direccion='cll 34 56-34';
    $minodo->latitud='4.15';
    $minodo->longitud='-73.64';
    $minodo->confianza = '20';
    $minodo->correo = $mail;
    $minodo->sitio_web = 'http://www.unillanos.edu.co/';    
    $minodo->facebook = 'http://facebook.com/';
    $minodo->twitter = 'https://twitter.com/';
    $minodo->youtube = 'http://www.youtube.com/';
    $minodo->contraseña = '123';
    $minodo->type = 'Empresa';
    
  
    
    ModelEmpresa::crearNodoEmpresa($minodo);
    
    
}
    
?>

