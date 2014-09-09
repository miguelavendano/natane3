<?php

require_once('coneccion.php');
require_once('modeloUsuario.php');
require_once('Usuario.php');

function creaNodoUsuario($nom,$ape,$img,$gen,$naci,$orig,$reci,$mail,$web,$face,$twit,$you,$contra){
    
    $minodo = new Usuario();
    $minodo->nombre = $nom;
    $minodo->apellido = $ape; 
    $minodo->imagen = $img;
    $minodo->nick = $nik;
    $minodo->genero = $gen;   
    $minodo->fecha_nacimiento = $naci;
    $minodo->ciudad_origen = $orig;
    $minodo->lugar_recidencia = $reci;
    $minodo->correo = $mail;
    $minodo->sitio_web = $web;    
    $minodo->facebook = $face;
    $minodo->twitter = $twit;
    $minodo->youtube = $you;
    $minodo->contraseña = $contra;
    $minodo->type = 'Usuario';
  
    ModelUsuarios::crearNodoUsuario($minodo);
    
}
    
?>
