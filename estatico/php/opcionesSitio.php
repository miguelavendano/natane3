<?php
session_start();
require_once('../../core/coneccion.php');
require_once('../../core/modeloSitio.php');
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
            
            $modelsitio = new ModelSitios();            
            $query = "START n=node(".$_POST['sitio'].") RETURN n";                        
            $resultado = $modelsitio->get_sitio($query);
            
            $band = array(
                "nombre"=> $resultado[0]->nombre,
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
                "pass"=> $resultado[0]->contraseña,
                "tipo"=> $resultado[0]->tipo_sitio,
                "imagen"=> $resultado[0]->imagen,
            );
                        
           $band = json_encode($band);
            
        break;    
    
        case "guardar_edicionS":  
                        
            ModelSitios::editar_sitio($_POST['sitio'], "nombre", $_POST['nombre']);
            ModelSitios::editar_sitio($_POST['sitio'], "descripcion", $_POST['descri']);
            ModelSitios::editar_sitio($_POST['sitio'], "ciudad", $_POST['city']);            
            ModelSitios::editar_sitio($_POST['sitio'], "direccion",$_POST['direc']);
            ModelSitios::editar_sitio($_POST['sitio'], "telefono", $_POST['tele']);
            ModelSitios::editar_sitio($_POST['sitio'], "correo", $_POST['mail']);
            ModelSitios::editar_sitio($_POST['sitio'], "latitud", $_POST['lat']);
            ModelSitios::editar_sitio($_POST['sitio'], "longitud", $_POST['lon']);             
            ModelSitios::editar_sitio($_POST['sitio'], "sitio_web", $_POST['s_web']);
            ModelSitios::editar_sitio($_POST['sitio'], "facebook", $_POST['face']);
            ModelSitios::editar_sitio($_POST['sitio'], "twitter", $_POST['twit']);
            ModelSitios::editar_sitio($_POST['sitio'], "youtube", $_POST['youtube']);
            ModelSitios::editar_sitio($_POST['sitio'], "tipo_sitio", $_POST['tipoSitio']);
            ModelSitios::editar_sitio($_POST['sitio'], "contraseña", $_POST['pass']);
            //ModelSitios::editar_sitio($_POST['usuario'], "imagen", );    
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