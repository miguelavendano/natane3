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

            $img='humadea.jpg';
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
    
        case "voto_sitio":
            
            $modelsitio = new ModelSitios();            
            $query = "START n=node(".$_POST['sitio'].") RETURN n";                        
            $resultado = $modelsitio->get_sitio($query);
            
            $susvotos = $resultado[0]->votos;
            
            //$voto = (int)$susvotos;
            //$voto++;
            $voto = $_POST['voto'] + (int)$susvotos;

            ModelSitios::editar_sitio($_POST['sitio'], "votos", $voto);  //aumenta los votos del sitio
            
            $band = "El sitio tiene $voto votos de confianza";
            
        break;
      
        case "visito":  
                                                                                //Visitante  
            ModeloRelaciones::crearRelacion($_POST['usuario'], $_POST['sitio'], "Fan");   //crea la relacion entre el usuario y la empresa que ha visitado           
            $band="true";
            
        break;    
    
        case "elimina-visita":  
  
            $idRelacion = ModeloRelaciones::consultarIDRelacion($_POST['usuario'], $_POST['sitio'], "Fan");  //consulto el ID de la relacion           
            ModeloRelaciones::eliminarRelacion($idRelacion);   //elimina la relacion entre el usuario y el sitio visitado
            $band="true";
            
        break;    

        case "quiere-visitar":  
   
            ModeloRelaciones::crearRelacion($_POST['usuario'], $_POST['sitio'], "Desea");   //crea la relacion entre el usuario y la empresa que ha visitado           
            $band="true";
            
        break;    
    
        case "elimina-intencion-visitar":  
  
            $idRelacion = ModeloRelaciones::consultarIDRelacion($_POST['usuario'], $_POST['sitio'], "Desea");  //consulto el ID de la relacion           
            ModeloRelaciones::eliminarRelacion($idRelacion);   //elimina la relacion entre el usuario y el sitio visitado
            $band="true";
            
        break;    
    
    
        case "mas-votos":
            
            $modelsitio = new ModelSitios();            
            $query = "START n=node(".$_POST['sitio'].") RETURN n";                        
            $resultado = $modelsitio->get_sitio($query);
            
            $susvotos = $resultado[0]->votos;
            
            $voto = (int)$susvotos;
            $voto++;            

            ModelSitios::editar_sitio($_POST['sitio'], "votos", $voto);  //aumenta los votos del sitio
            
            $band = "<h5>$voto Personas confían en este sitio</h5>";
            
        break;

        case "menos-votos":
            
            $modelsitio = new ModelSitios();            
            $query = "START n=node(".$_POST['sitio'].") RETURN n";                        
            $resultado = $modelsitio->get_sitio($query);
            
            $susvotos = $resultado[0]->votos;
            
            $voto = (int)$susvotos;
            $voto--;

            ModelSitios::editar_sitio($_POST['sitio'], "votos", $voto);  //aumenta los votos del sitio
            
            $band = "<h5>$voto Personas confían en este sitio</h5>";
            
        break;    
    
        default : break; 
    }    
    
    echo $band;
}

?>