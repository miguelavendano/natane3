<?php
require_once('../../../core/coneccion.php');
require_once('../../../core/modeloSitio.php');
require_once('../../../core/Sitio.php');

function creaNodoSitio($nom,$desc,$img,$tipo,$orig,$mail){
    
    $minodo = new Sitio();
    $minodo->nombre = $nom;
    $minodo->imagen = $img;
    $minodo->tipo_sitio = $tipo;    
    $minodo->descripcion = $desc;
    $minodo->ciudad = $orig;
    $minodo->telefono= '6828345';
    $minodo->direccion='cll 32 #45-32';
    $minodo->latitud='4.15';
    $minodo->longitud='-73.64';    
    $minodo->correo = $mail;
    $minodo->sitio_web = 'http://www.unillanos.edu.co/'; 
    $minodo->facebook = 'http://facebook.com/';
    $minodo->twitter = 'https://twitter.com/';
    $minodo->youtube = 'http://www.youtube.com/';
    $minodo->type = 'Sitio';
           
    ModelSitios::crearNodoSitio($minodo);       
    
}
    
?>

