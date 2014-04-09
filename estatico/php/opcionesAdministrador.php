<?php
session_start();
require_once('../../core/coneccion.php');
require_once('../../core/modeloAdministrador.php');
require_once('../../core/modeloPublicacion.php');
require_once('../../core/modeloRelaciones.php');
require_once('../../core/modeloImagen.php');



if(isset($_POST['opcion'])){
    
    $band="false";
    $opcion=$_POST['opcion'];
            
    switch ($opcion){
           
        case "creaNoticia":
            
            $id_admin='16708';
            
            $nodo_publicacion = new Publicacion();
            $nodo_publicacion->nombre = $_POST['nomNoti'];
            $nodo_publicacion->descripcion = $_POST['descNoti'];
            $nodo_publicacion->fecha = date("d")." de ".date("F")." de ".date("Y")." a la(s) ".date("H:i");
            $nodo_publicacion->type = 'Noticia';
            ModelPublicacion::crearNodoNoticia($nodo_publicacion);

            $id_noticia = $nodo_publicacion->id;  //obtengo el id del nodo creado                                    
            ModeloRelaciones::crearRelacion($id_admin, $id_noticia, "Informa");   //crea la relacion entre el admin y la noticia
            
            //guarda la imagen de la noticia
            $upload_folder ='../../estatico/imagenes/';
            foreach($_FILES['imagen_noticia']['error'] as $key => $error){                
                if($error == UPLOAD_ERR_OK){                    
                    //alamaceno la imagen
                    $nombre_archivo = $_FILES["imagen_noticia"]['name'][$key];
                    $tmp_archivo = $_FILES["imagen_noticia"]['tmp_name'][$key];            

                    //creo el nombre unico para la imagen
                    $nomImgNoticia = $id_admin.'_'.$id_noticia.'_'.$nombre_archivo;
                    
                    ModelPublicacion::editar_publicacion($id_noticia, 'imagen', $nomImgNoticia);
                    //almaceno la imagen en la carpeta del servidor                                        
                    move_uploaded_file($tmp_archivo, $upload_folder.$nomImgNoticia);   //guarda la imagen                    
                }
            }
            
            $band="true";
            
        break;        
        
        case "creaEvento":
            
            $id_admin='16708';
            
            $nodo_publicacion = new Publicacion();
            $nodo_publicacion->nombre = $_POST['nomEve'];
            $nodo_publicacion->descripcion = $_POST['descEve'];
            $nodo_publicacion->fecha_evento = $_POST['fechaEve'];
            $nodo_publicacion->hora_evento = $_POST['horaEve'];
            $nodo_publicacion->fecha = date("d")." de ".date("F")." de ".date("Y")." a la(s) ".date("H:i");
            $nodo_publicacion->type = 'Evento';
            ModelPublicacion::crearNodoEvento($nodo_publicacion);

            $id_evento = $nodo_publicacion->id;  //obtengo el id del nodo creado                                    
            ModeloRelaciones::crearRelacion($id_admin, $id_evento, "Informa");   //crea la relacion entre el admin y la noticia
            
            //guarda la imagen de la noticia
            $upload_folder ='../../estatico/imagenes/';
            foreach($_FILES['imagen_evento']['error'] as $key => $error){                
                if($error == UPLOAD_ERR_OK){                    
                    //alamaceno la imagen
                    $nombre_archivo = $_FILES["imagen_evento"]['name'][$key];
                    $tmp_archivo = $_FILES["imagen_evento"]['tmp_name'][$key];            

                    //creo el nombre unico para la imagen
                    $nomImgEvento = $id_admin.'_'.$id_evento.'_'.$nombre_archivo;
                    
                    ModelPublicacion::editar_publicacion($id_evento, 'imagen', $nomImgEvento);
                    //almaceno la imagen en la carpeta del servidor                                        
                    move_uploaded_file($tmp_archivo, $upload_folder.$nomImgEvento);   //guarda la imagen                    
                }
            }
            
            $band="true";
            
        break;        
        
    
        case "eliminaPublicacion":
                
            $id_admin='16708';
            // obtengo el id de la relacion Administrador-Publicacion (Informa)
            $id_relacionAdminPub = ModeloRelaciones::consultarIDRelacion($id_admin, $_POST['publicacion'], 'Informa');           

            if($id_relacionAdminPub){
                ModeloRelaciones::eliminarRelacion($id_relacionAdminPub);                                
                ModelPublicacion::eliminar_publicacion($_POST['publicacion']);
                $band="true";
            }                                
            
        break;                
    
        case "datosEdicionPublicacion":                       
            

            $query = "START n=node(".$_POST['publicacion'].") RETURN n"; 
            
            if($_POST['tipo']=='Noticia'){                
                
                $resultado = ModelPublicacion::get_noticias($query);    
                
                $band = array(
                    "tipo"=> $resultado[0]->type,
                    "nombre"=> $resultado[0]->nombre,
                    "descripcion"=> $resultado[0]->descripcion
                );                
                
                
            }else if($_POST['tipo']=='Evento'){
                
                $resultado = ModelPublicacion::get_eventos($query);

                $band = array(
                    "tipo"=> $resultado[0]->type,
                    "nombre"=> $resultado[0]->nombre,
                    "descripcion"=> $resultado[0]->descripcion,
                    "fecha"=> $resultado[0]->fecha_evento,
                    "hora"=> $resultado[0]->hora_evento,
                );                                
            }
            
            /*                        
            $lista_imgs = $modelexperiencia->get_imagenes_experiencia($_POST['experiencia']);            
            //inserto el array de imagenes al array de las propiedades de la  experiencia
            array_push($band, $lista_imgs);                                                    
            
            //cambio el nombre que asigna la insertar el array de imagenes
            $band["imagenes"] = $band["0"];
            unset($band["0"]);
            */
            //combierto el array en un json
            $band = json_encode($band);           
            
        break;    

        case "guardaEdicionPublicacion":                                                                      

            if($_POST['tipo']=='Noticia'){                
                
                ModelPublicacion::editar_publicacion($_POST['publicacion'], "nombre", $_POST['EnomNoti']);
                ModelPublicacion::editar_publicacion($_POST['publicacion'], "descripcion", $_POST['EdescNoti']);                            
                
                if($_FILES["Eimagen_noticia"]!=""){

                    $id_admin='16708';                    
                    //guarda la imagen de la noticia
                    $upload_folder ='../../estatico/imagenes/';
                    foreach($_FILES['Eimagen_noticia']['error'] as $key => $error){                
                        if($error == UPLOAD_ERR_OK){                    
                            //alamaceno la imagen
                            $nombre_archivo = $_FILES["Eimagen_noticia"]['name'][$key];
                            $tmp_archivo = $_FILES["Eimagen_noticia"]['tmp_name'][$key];            

                            //creo el nombre unico para la imagen
                            $nomImgNoticia = $id_admin.'_'.$_POST['publicacion'].'_'.$nombre_archivo;

                            ModelPublicacion::editar_publicacion($_POST['publicacion'], 'imagen', $nomImgNoticia);
                            //almaceno la imagen en la carpeta del servidor                                        
                            move_uploaded_file($tmp_archivo, $upload_folder.$nomImgNoticia);   //guarda la imagen                    
                        }
                    }   
                }                
                
            }else if($_POST['tipo']=='Evento'){
                
                ModelPublicacion::editar_publicacion($_POST['publicacion'], "nombre", $_POST['EnomEve']);
                ModelPublicacion::editar_publicacion($_POST['publicacion'], "descripcion", $_POST['EdescEve']);                            
                ModelPublicacion::editar_publicacion($_POST['publicacion'], "fecha_evento", $_POST['EfechaEve']);
                ModelPublicacion::editar_publicacion($_POST['publicacion'], "hora_evento", $_POST['EhoraEve']);
                
                if($_FILES["Eimagen_evento"]!=""){

                    $id_admin='16708';                    
                    //guarda la imagen de la noticia
                    $upload_folder ='../../estatico/imagenes/';
                    foreach($_FILES['Eimagen_evento']['error'] as $key => $error){                
                        if($error == UPLOAD_ERR_OK){                    
                            //alamaceno la imagen
                            $nombre_archivo = $_FILES["Eimagen_evento"]['name'][$key];
                            $tmp_archivo = $_FILES["Eimagen_evento"]['tmp_name'][$key];            

                            //creo el nombre unico para la imagen
                            $nomImgNoticia = $id_admin.'_'.$_POST['publicacion'].'_'.$nombre_archivo;

                            ModelPublicacion::editar_publicacion($_POST['publicacion'], 'imagen', $nomImgNoticia);
                            //almaceno la imagen en la carpeta del servidor                                        
                            move_uploaded_file($tmp_archivo, $upload_folder.$nomImgNoticia);   //guarda la imagen                    
                        }
                    }   
                }                                
            }            
            
            $band="true";
            
        break;              
        
        case "EstadisticasNodos":
            
            $datos = array();
            $datos['usuarios'] = ModelAdministrador::get_totalNodos('Usuario');
            $datos['empresas'] = ModelAdministrador::get_totalNodos('Empresa');
            $datos['sitios'] = ModelAdministrador::get_totalNodos('Sitio');
            $datos['experiencias'] = ModelAdministrador::get_totalNodos('Experiencia');
            $datos['servicios'] = ModelAdministrador::get_totalNodos('Servicio');
            $datos['imagenes'] = ModelAdministrador::get_totalNodos('Imagen');
            $datos['comentarios'] = ModelAdministrador::get_totalNodos('Comentario');            
            $datos['noticias'] = ModelAdministrador::get_totalNodos('Noticia');
            $datos['eventos'] = ModelAdministrador::get_totalNodos('Evento');
                            
            $band = json_encode($datos);
            
        break;                

        
        case "EstadisticasRelaciones":
            
            $datos = array();
            $datos['informa'] = ModelAdministrador::get_totalRelaciones('Informa');
            $datos['amigos'] = ModelAdministrador::get_totalRelaciones('Amigo');
            $datos['comparte'] = ModelAdministrador::get_totalRelaciones('Comparte');
            $datos['publica'] = ModelAdministrador::get_totalRelaciones('Publica');
            $datos['crea'] = ModelAdministrador::get_totalRelaciones('Crea');
                            
            $band = json_encode($datos);
            
        break;                    
        default : break; 
    }    
    
    echo $band;
}

?>