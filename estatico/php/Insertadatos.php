<?php

require_once('../../core/coneccion.php');
require_once('../../core/modeloUsuario.php');
require_once('../../core/modeloExperiencia.php');
require_once '../../core/modeloRelaciones.php';





if(isset($_POST['opcion'])){
    
    $band="false";
    $la_opcion=$_POST['opcion'];
            
    switch ($la_opcion){
        
        // BUSQUEDA
        case "busca":                       
            
            //header('Location: http://localhost/natane3/modulos/consultas/consulta.php');
            //header("Location: http://www.google.com");
            /*
            if($_POST['busca']){
                $band= true;
                 echo "esta buscando".$_POST['busca'];
                }
            else {
                $band= false;
                echo"no ingreso datos a la busqueda";
            }*/
            
        break;

        // Registro de un Usuario
        case "registrar":                       

          
            $orig='Bogota';
            $reci='Villavicencio';
            $img='julian.jpg';               
            $nik=substr($_POST['nombre'],0,3)."_".substr($_POST['apellido'],0,3); 
            $web=$_POST['nombre'].$_POST['apellido'].substr($_POST['apellido'],0,1).".com";
            $face='http://www.facebook.com/AnDaLaTo';    
            $twit='https://twitter.com/JulianDVarelaP';
            $you='http://www.youtube.com/user/GisoftCo';

            $minodo = new Usuario();
            $minodo->nombre = $_POST['nombre'];
            $minodo->apellido = $_POST['apellido'];
            $minodo->imagen = $img;
            $minodo->nick = $nik;
            $minodo->genero = $_POST['genero'];
            $minodo->fecha_nacimiento = $_POST['nacimiento'];
            $minodo->ciudad_origen = $orig;
            $minodo->lugar_recidencia = $reci;
            $minodo->correo = $_POST['mail'];
            $minodo->sitio_web = $web;    
            $minodo->facebook = $face;
            $minodo->twitter = $twit;
            $minodo->youtube = $you;
            $minodo->contraseña = $_POST['contra1'];
            $minodo->type = 'Usuario';

            ModelUsuarios::crearNodoUsuario($minodo); //crea el nodo del Usuario 
            $band=$minodo->id;  //obtengo el id del nodo creado
            $band=$band." true";
            
        break;

        case "experiencia":                       
            
            
            $minodo = new Experiencia();
            $minodo->nombre = $_POST['titulo'];
            $minodo->descripcion = $_POST['descripcion'];
            $minodo->type = 'Experiencia';
            
            ModelExperiencia::crearNodoExperiencia($minodo);  //crea el nodo de la experiencia
            
            $id_exp = $minodo->id;  //obtengo el id del nodo creado            
                        
            ModeloRelaciones::crearRelacion($_POST['autor'], $id_exp, "Comparte");   //crea la relacion entre el autor y la experiencia
            
            
            $band="true";
            
        break;
    
    
        default : break; 
            
    }    
    
    echo $band;
}

?>

       
