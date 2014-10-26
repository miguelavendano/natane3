<?php
session_start();
require_once('../../core/coneccion.php');
require_once('../../core/modeloUsuario.php');
require_once('../../core/modeloExperiencia.php');
require_once('../../core/modeloRelaciones.php');
require_once('../../core/modeloImagen.php');


if(isset($_POST['opcion'])){
    
    $band="true";
    $opcion=$_POST['opcion'];
            
    switch ($opcion){
      
        
        case "login":                       
        
            $band="false";
            
        break;
      
        default : break; 
    }    
    
    echo $band;
}

?>