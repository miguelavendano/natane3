<?php
session_start();
require_once('../../core/coneccion.php');
require_once('../../core/modeloEmpresa.php');
require_once('../../core/modeloExperiencia.php');
require_once('../../core/modeloRelaciones.php');


if(isset($_POST['opcion'])){
    
    $band="false";
    $opcion=$_POST['opcion'];
            
    switch ($opcion){

        // Registro de un Usuario
        case "registrarE":                       
                      
            $img='elcielo.jpg';            

            $nodo_empresa = new Empresa();
            $nodo_empresa->nombre = $_POST['nombre'];            
            $nodo_empresa->imagen = $img;
            $nodo_empresa->nit = $_POST['nit'];
            $nodo_empresa->descripcion = $_POST['desc'];
            $nodo_empresa->ciudad = $_POST['city'];
            $nodo_empresa->telefono = $_POST['tel'];
            $nodo_empresa->direccion = $_POST['dir'];
            $nodo_empresa->latitud = $_POST['lat'];
            $nodo_empresa->longitud = $_POST['lon'];
            $nodo_empresa->correo = $_POST['mail'];
            $nodo_empresa->empresa_web = $_POST['web'];    
            $nodo_empresa->facebook = $_POST['face'];
            $nodo_empresa->twitter = $_POST['twit'];
            $nodo_empresa->youtube = $_POST['you'];
            $nodo_empresa->contraseña = $_POST['contra1'];
            $nodo_empresa->type = 'Empresa';
            ModelEmpresa::crearNodoEmpresa($nodo_empresa); //crea el nodo del Usuario 
                        
            $band=$nodo_empresa->id;  //obtengo el id del nodo creado
            $band=$band." true";

        break;

        case "editarE":
            
            $modelempresa = new ModelEmpresa();            
            $query = "START n=node(".$_POST['empresa'].") RETURN n";                        
            $resultado = $modelempresa->get_empresa($query);
            
            $band = array(
                "nombre"=> $resultado[0]->nombre,
                "nit"=> $resultado[0]->nit,
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
                "imagen"=> $resultado[0]->imagen,
            );
                        
           $band = json_encode($band);
            
        break;    
    
        case "guardar_edicionE":  
                        
            ModelEmpresa::editar_empresa($_POST['empresa'], "nombre", $_POST['nombre']);
            ModelEmpresa::editar_empresa($_POST['empresa'], "nit", $_POST['nit']);            
            ModelEmpresa::editar_empresa($_POST['empresa'], "descripcion", $_POST['descri']);
            ModelEmpresa::editar_empresa($_POST['empresa'], "ciudad", $_POST['city']);            
            ModelEmpresa::editar_empresa($_POST['empresa'], "direccion",$_POST['direc']);
            ModelEmpresa::editar_empresa($_POST['empresa'], "telefono", $_POST['tele']);
            ModelEmpresa::editar_empresa($_POST['empresa'], "correo", $_POST['mail']);
            ModelEmpresa::editar_empresa($_POST['empresa'], "latitud", $_POST['lat']);
            ModelEmpresa::editar_empresa($_POST['empresa'], "longitud", $_POST['lon']);             
            ModelEmpresa::editar_empresa($_POST['empresa'], "sitio_web", $_POST['s_web']);
            ModelEmpresa::editar_empresa($_POST['empresa'], "facebook", $_POST['face']);
            ModelEmpresa::editar_empresa($_POST['empresa'], "twitter", $_POST['twit']);
            ModelEmpresa::editar_empresa($_POST['empresa'], "youtube", $_POST['youtube']);
            ModelEmpresa::editar_empresa($_POST['empresa'], "contraseña", $_POST['pass']);
            //ModelEmpresa::editar_empresa($_POST['usuario'], "imagen", );    
            $band="true";
            
        break;    
    
        case "da_confianza":  
  
            $modelempresa = new ModelEmpresa();            
            $query = "START n=node(".$_POST['empresa'].") RETURN n";                        
            $resultado = $modelempresa->get_empresa($query);
            
            $confianza = $resultado[0]->confianza;
            
            $puntos = (int)$confianza;
            $puntos++;
                                                
            ModelEmpresa::editar_empresa($_POST['empresa'], "confianza", $puntos);   //aumenta los puntos de confianza
                     
            ModeloRelaciones::crearRelacion($_POST['usuario'], $_POST['empresa'], "Cliente");   //crea la relacion entre el usuario y la empresa
            
            $html = "<a class='btn btn-cyan active btn-block'>
                        <h4>$puntos Puntos de Confianza</h4>
                    </a>";
            
            $band="";
            $band=$html;
            
        break;    
    
        case "quita_confianza":  
  
            $modelempresa = new ModelEmpresa();            
            $query = "START n=node(".$_POST['empresa'].") RETURN n";                        
            $resultado = $modelempresa->get_empresa($query);
                        
            $confianza = $resultado[0]->confianza;
            
            $puntos = (int)$confianza;
            $puntos--;            
                                  
            ModelEmpresa::editar_empresa($_POST['empresa'], "confianza", $puntos);     //disminuye los puntos de confianza

            $idRelacion = ModeloRelaciones::consultarIDRelacion($_POST['usuario'], $_POST['empresa'], "Cliente");  //consulto el ID de la relacion
            
            ModeloRelaciones::eliminarRelacion($idRelacion);   //elimina la relacion entre el usuario y la empresa
            
            $html = "<a class='btn btn-cyan active btn-block'>
                        <h4>$puntos Puntos de Confianza</h4>
                    </a>";
            
            $band="";
            $band=$html;
            
        break;    
    
        default : break; 
    }    
    
    echo $band;
}

?>