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

            $nodo_usuario = new Usuario();
            $nodo_usuario->nombre = $_POST['nombre'];
            $nodo_usuario->apellido = $_POST['apellido'];
            $nodo_usuario->imagen = $img;
            $nodo_usuario->nick = $nik;
            $nodo_usuario->genero = $_POST['genero'];
            $nodo_usuario->fecha_nacimiento = $_POST['nacimiento'];
            $nodo_usuario->ciudad_origen = $orig;
            $nodo_usuario->lugar_recidencia = $reci;
            $nodo_usuario->correo = $_POST['mail'];
            $nodo_usuario->sitio_web = $web;    
            $nodo_usuario->facebook = $face;
            $nodo_usuario->twitter = $twit;
            $nodo_usuario->youtube = $you;
            $nodo_usuario->contraseña = $_POST['contra1'];
            $nodo_usuario->type = 'Usuario';
            ModelUsuarios::crearNodoUsuario($nodo_usuario); //crea el nodo del Usuario 
            
            $band=$nodo_usuario->id;  //obtengo el id del nodo creado
            $band=$band." true";
            
        break;

        case "experiencia":                       
            
            $nodo_experiencia = new Experiencia();
            $nodo_experiencia->nombre = $_POST['titulo'];
            $nodo_experiencia->descripcion = $_POST['descripcion'];
            $nodo_experiencia->type = 'Experiencia';            
            ModelExperiencia::crearNodoExperiencia($nodo_experiencia);  //crea el nodo de la experiencia
            
            $id_exp = $nodo_experiencia->id;  //obtengo el id del nodo creado                                    
            ModeloRelaciones::crearRelacion($_POST['autor'], $id_exp, "Comparte");   //crea la relacion entre el autor y la experiencia

            /*
            $nodo_imagen = new Imagen();
            $nodo_imagen->nombre = $_POST['nom_img'];
            $nodo_imagen->descripcion = $_POST['desc_img'];
            $nodo_imagen->comentario1 = "";
            $nodo_imagen->type = 'Imagen';  
            ModelImagen::crearNodoImagen($nodo_imagen);  //crea el nodo de la imagen

            $id_img = $nodo_imagen->id;  //obtengo el id del nodo creado                   
            ModeloRelaciones::crearRelacion($id_exp, $id_img, "Img");   //crea la relacion entre la experiencia y la imagen
            */
            $band="true";
            
        break;
    
    
        default : break; 
            
    }    
    
    echo $band;
}

?>

       
