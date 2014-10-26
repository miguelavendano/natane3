<?php

require_once('../../../core/coneccion.php');
require_once('../../../core/modeloAdministrador.php');
require_once('../../../core/Administrador.php');

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
