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
            echo $band;
            $img='humadea.jpg;';
            $web=$_POST['nombre']."_".substr($_POST['nombre'],0,1).".com";
            $face='http://www.facebook.com/AnDaLaTo';    
            $twit='https://twitter.com/JulianDVarelaP';
            $you='http://www.youtube.com/user/GisoftCo';

            $nodo_sitio = new Sitio();
            $nodo_sitio->nombre = $_POST['nombre'];            
            $nodo_sitio->imagen = $img;
            $nodo_sitio->tipo_sitio = $_POST['tipo'];
            $nodo_sitio->descripcion = $_POST['desc'];                        
            $nodo_sitio->ciudad = $_POST['city'];
            $nodo_sitio->telefono = $_POST['tel'];
            $nodo_sitio->direccion = $_POST['dir'];
            $nodo_sitio->latitud = $_POST['lat'];
            $nodo_sitio->longitud = $_POST['lon'];
            $nodo_sitio->correo = $_POST['mail'];            
            /*$nodo_sitio->empresa_web = $_POST['web'];    
            $nodo_sitio->facebook = $_POST['face'];
            $nodo_sitio->twitter = $_POST['twit'];
            $nodo_sitio->youtube = $_POST['you'];*/
            $nodo_sitio->empresa_web = $web;
            $nodo_sitio->facebook = $face;
            $nodo_sitio->twitter = $twit;
            $nodo_sitio->youtube = $you;            
            $nodo_sitio->contraseña = $_POST['contra1'];
            $nodo_sitio->type = 'Sitio';
            ModelSitios::crearNodoSitio($nodo_sitio); //crea el nodo del Sitio
            
            $band="";
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
            ModelSitios::editar_sitio($_POST['sitio'], "tipo_sitio", $_POST['tsitio']);
            ModelSitios::editar_sitio($_POST['sitio'], "contraseña", $_POST['pass']);
            //ModelSitios::editar_sitio($_POST['usuario'], "imagen", );    
            $band="true";
            
        break;    
    
        default : break; 
    }    
    
    echo $band;
}

?>