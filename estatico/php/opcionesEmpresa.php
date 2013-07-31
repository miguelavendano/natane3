<?php
session_start();
require_once('../../core/coneccion.php');
require_once('../../core/modeloUsuario.php');
require_once('../../core/modeloExperiencia.php');
require_once('../../core/modeloRelaciones.php');


if(isset($_POST['opcion'])){
    
    $band="false";
    $opcion=$_POST['opcion'];
            
    switch ($opcion){

        // Registro de un Usuario
        case "registrarS":                       
            
            $orig='Bogota';
            $reci='Villavicencio';
            $img='acacias-meta.jpg';               
            $nik=substr($_POST['nombre'],0,3)."_".substr($_POST['apellido'],0,3); 
            $web=$_POST['nombre'].$_POST['apellido'].substr($_POST['apellido'],0,1).".com";
            $face='http://www.facebook.com/AnDaLaTo';    
            $twit='https://twitter.com/JulianDVarelaP';
            $you='http://www.youtube.com/user/GisoftCo';

            $nodo_sitio = new Sitio();
            $nodo_sitio->nombre = $_POST['nombre'];            
            $nodo_sitio->imagen = $img;
            $nodo_sitio->tipo_sitio = '';
            $nodo_sitio->descripcion = '';
            $nodo_sitio->ciudad = '';
            $nodo_sitio->telefono = '';
            $nodo_sitio->direccion = '';
            $nodo_sitio->latitud = '';
            $nodo_sitio->longitud = '';
            $nodo_sitio->correo = $_POST['mail'];
            $nodo_sitio->sitio_web = $web;    
            $nodo_sitio->facebook = $face;
            $nodo_sitio->twitter = $twit;
            $nodo_sitio->youtube = $you;
            $nodo_sitio->contraseña = $_POST['contra1'];
            $nodo_sitio->type = 'Usuario';
            ModelUsuarios::crearNodoUsuario($nodo_sitio); //crea el nodo del Usuario 
            
            $band=$nodo_sitio->id;  //obtengo el id del nodo creado
            $band=$band." true";
            
        break;

        case "editarS":                       
            
            $modelusuarios = new ModelUsuarios();            
            $query = "START n=node(".$_POST['autor'].") RETURN n";                        
            $resultado = $modelusuarios->get_usuario($query);
            
            $band = array(
                "nombre"=> $resultado[0]->nombre,
                "imagen"=> $resultado[0]->imagen,
                "tipo"=> $resultado[0]->tipo_sitio,
                "desc"=> $resultado[0]->descripcion,
                "city"=> $resultado[0]->ciudad,
                "tel"=> $resultado[0]->telefono,
                "direc"=> $resultado[0]->direccion,
                "lat"=> $resultado[0]->latitud,
                "lon"=> $resultado[0]->longitud,
                "mail"=> $resultado[0]->correo,
                "s_web"=> $resultado[0]->sitio_web,
                "face"=> $resultado[0]->facebook,
                "twi"=> $resultado[0]->twitter,
                "you"=> $resultado[0]->youtube,
                "pass"=> $resultado[0]->contraseña
            );
                        
           $band = json_encode($band);
            
        break;    
    
        case "guardar_edicionS":                                                                      
           
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