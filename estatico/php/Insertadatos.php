<?php
session_start();
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
    
        case "editarU":                       
            
            $modelusuarios = new ModelUsuarios();            
            $query = "START n=node(".$_POST['autor'].") RETURN n";                        
            $resultado = $modelusuarios->get_usuario($query);
            
            $band = array(
                "nombre"=> $resultado[0]->nombre,
                "apellido"=> $resultado[0]->apellido,
                "imagen"=> $resultado[0]->imagen,
                "nick"=> $resultado[0]->nick,
                "genero"=> $resultado[0]->genero,
                "f_nace"=> $resultado[0]->fecha_nacimiento,
                "city"=> $resultado[0]->ciudad_origen,
                "recide"=> $resultado[0]->lugar_recidencia,
                "mail"=> $resultado[0]->correo,
                "s_web"=> $resultado[0]->sitio_web,
                "face"=> $resultado[0]->facebook,
                "twi"=> $resultado[0]->twitter,
                "you"=> $resultado[0]->youtube,
                "pass"=> $resultado[0]->contraseña
            );
                        
           $band = json_encode($band);
            
        break;    
    
        case "guardar_edicionU":                                                                      
           
            ModelUsuarios::editar_usuario($_POST['usuario'], "nombre", $_POST['nombre']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "apellido", $_POST['apellido']);            
            //ModelUsuarios::editar_usuario($_POST['usuario'], "imagen", );         
            ModelUsuarios::editar_usuario($_POST['usuario'], "nick", $_POST['nick']);            
            ModelUsuarios::editar_usuario($_POST['usuario'], "genero",$_POST['genero']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "fecha_nacimiento", $_POST['f_nace']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "ciudad_origen", $_POST['city']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "lugar_recidencia", $_POST['recide']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "correo", $_POST['mail']); 
            ModelUsuarios::editar_usuario($_POST['usuario'], "sitio_web", $_POST['s_web']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "facebook", $_POST['face']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "twitter", $_POST['twit']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "youtube", $_POST['youtube']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "contraseña", $_POST['pass']);
            
            $band="true";
            
        break;    
    
        case "relacion_amigo":                       
            
            ModeloRelaciones::crearRelacion($_POST['usuario'], $_POST['amigo'], "Amigo");   //crea la relacion de amistad
            
            $band = 'true';
            
        break;    

        case "login":                                                                      

            $modelusuarios = new ModelUsuarios();            
            $query = "START n=node:Usuario(nombre='".$_POST['usuario']."') RETURN n";
            $resultado = $modelusuarios->get_usuario($query);
            
            echo $resultado[0]->id."  --  ";            
            echo $resultado[0]->correo."  --  ";
            echo $resultado[0]->contraseña."  --  ";
                  
            
            $_SESSION["id"] = $resultado[0]->id;
            
            if($_POST['usuario'] == $resultado[0]->correo && $_POST['clave'] == $resultado[0]->contraseña){
                $band="true";   
            }
            else {
                $band="false";
            }
            
            
        break;    
    
        default : break; 
    }    
    
    echo $band;
}

?>