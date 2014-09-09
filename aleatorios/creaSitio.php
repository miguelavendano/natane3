<?php
require_once('coneccion.php');
require_once('modeloSitio.php');
require_once('Sitio.php');

function creaNodoSitio($nom,$desc,$img,$tipo,$tel,$orig,$dir,$mail,$web,$face,$twit,$you){
    
    $minodo = new Sitio();
    $minodo->nombre = $nom;
    $minodo->imagen = $img;
    $minodo->tipo_sitio = $tipo;    
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
    $minodo->type = 'Sitio';
    
    ModelSitios::crearNodoSitio($minodo);       
    
}
    
?>

