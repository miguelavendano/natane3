<?php

require_once('coneccion.php');
require_once('modeloAdministrador.php');
require_once('Administrador.php');

function creaNodoUsuario($nom,$ape,$img,$mail,$contra){
    
    $minodo = new Administrador();
    $minodo->nombre = $nom;
    $minodo->apellido = $ape; 
    $minodo->imagen = $img;
    $minodo->nick = "Administrador";
    $minodo->correo = $mail;
    $minodo->password = $contra;
    $minodo->type = 'Administrador';
            
    ModelAdministrador::crearNodoAdministrador($minodo);
    
}
    
?>
