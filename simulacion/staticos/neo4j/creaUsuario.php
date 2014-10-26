<?php

require_once('../../../core/coneccion.php');
require_once('../../../core/modeloUsuario.php');
require_once('../../../core/Usuario.php');

function creaNodoUsuario($nom,$ape,$img,$gen,$nik, $orig,$reci,$mail){
    
    $minodo = new Usuario();
    $minodo->nombre = $nom;
    $minodo->apellido = $ape; 
    $minodo->imagen = $img;
    $minodo->nick = $nik;
    $minodo->genero = $gen;   
    $minodo->fecha_nacimiento = "12/09/1990";
    $minodo->ciudad_origen = $orig;
    $minodo->lugar_recidencia = $reci;
    $minodo->correo = $mail;
    $minodo->sitio_web = 'http://www.unillanos.edu.co/';    
    $minodo->facebook = 'http://facebook.com/';
    $minodo->twitter = 'https://twitter.com/';
    $minodo->youtube = 'http://www.youtube.com/';
    $minodo->contraseña = '123';
    $minodo->type = 'Usuario';  

    ModelUsuarios::crearNodoUsuario($minodo);
    
}
    
?>
