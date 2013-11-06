<?php
session_start();
require_once('../../core/coneccion.php');
require_once('../../core/modeloUsuario.php');
require_once('../../core/modeloExperiencia.php');
require_once('../../core/modeloImagen.php');
require_once('../../core/modeloRelaciones.php');


if(isset($_POST['opcion'])){
    
    $band="false";
    $opcion=$_POST['opcion'];
            
    switch ($opcion){
       
        // Registro de un Usuario
        case "registrarU":                       

            $nodo_usuario = new Usuario();
            $nodo_usuario->nombre = $_POST['nombre'];
            $nodo_usuario->apellido = $_POST['apellido'];            
            $nodo_usuario->genero = $_POST['genero'];
            $nodo_usuario->fecha_nacimiento = $_POST['nacimiento'];
            $nodo_usuario->correo = $_POST['mail'];
            $nodo_usuario->imagen = "usuario_sin_avatar.jpg";            
            /*
            $nodo_usuario->nick = $nik;
            $nodo_usuario->ciudad_origen = $orig;
            $nodo_usuario->lugar_recidencia = $reci;            
            $nodo_usuario->sitio_web = $web;    
            $nodo_usuario->facebook = $face;
            $nodo_usuario->twitter = $twit;
            $nodo_usuario->youtube = $you;*/
            $nodo_usuario->contraseña = $_POST['contra1'];
            $nodo_usuario->type = 'Usuario';
            ModelUsuarios::crearNodoUsuario($nodo_usuario); //crea el nodo del Usuario 
            
            $band=$nodo_usuario->id;  //obtengo el id del nodo creado
            $band=$band." true";
            
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
    
        case "ediFotoPerfil":       
            
            $upload_folder ='../../estatico/imagenes/';
            
            foreach($_FILES['foto_perfil']['error'] as $key => $error){                
                if($error == UPLOAD_ERR_OK){                    
                    $nombre_archivo = $_FILES['foto_perfil']['name'][$key];
                    $tmp_archivo = $_FILES['foto_perfil']['tmp_name'][$key];            
                    //$tipo_archivo = $_FILES['foto_perfil']['type'][$key];
                    //$tamano_archivo = $_FILES['foto_perfil']['size'][$key];

                    //echo $nombre_archivo;
                    $nomFotoPerfil = $_POST['usuario'].'_'.$nombre_archivo;
                    
                    move_uploaded_file($tmp_archivo, $upload_folder.$nomFotoPerfil);   //guarda la imagen
                }
            }            
            
            ModelUsuarios::editar_usuario($_POST['usuario'], "imagen", $nomFotoPerfil);         
            
            $band="true";
            
        break;        
        
        case "crea_experiencia":                       
            
            $nodo_experiencia = new Experiencia();
            $nodo_experiencia->nombre = $_POST['Exptitulo'];
            $nodo_experiencia->descripcion = $_POST['Expdesc'];
            $nodo_experiencia->type = 'Experiencia';            
            ModelExperiencia::crearNodoExperiencia($nodo_experiencia);  //crea el nodo de la experiencia
            
            $id_exp = $nodo_experiencia->id;  //obtengo el id del nodo creado                                    
            ModeloRelaciones::crearRelacion($_POST['autor'], $id_exp, "Comparte");   //crea la relacion entre el autor y la experiencia
            
            $upload_folder ='../../estatico/imagenes/';
            foreach($_FILES['imagenes_experiencia']['error'] as $key => $error){                
                if($error == UPLOAD_ERR_OK){                    
                    //alamaceno la imagen
                    $nombre_archivo = $_FILES["imagenes_experiencia"]['name'][$key];
                    $tmp_archivo = $_FILES["imagenes_experiencia"]['tmp_name'][$key];            
                    //$tipo_archivo = $_FILES["imagenes_experiencia"]['type'][$key];
                    //$tamano_archivo = $_FILES["imagenes_experiencia"]['size'][$key];

                    //almaceno la imagen en la carpeta del servidor                    
                    $nomImgExpUser = $_POST['autor'].'_'.$id_exp.'_'.$nombre_archivo;
                    
                    move_uploaded_file($tmp_archivo, $upload_folder.$nomImgExpUser);   //guarda la imagen

                    //crea el nodo de cada una de las imagenes
                    $nodo_imagen = new Imagen();
                    $nodo_imagen->nombre = $nomImgExpUser;
                    $nodo_imagen->descripcion = "";
                    $nodo_imagen->type = 'Imagen';  
                    ModelImagen::crearNodoImagen($nodo_imagen);  //crea el nodo de la imagen

                    $id_img = $nodo_imagen->id;  //obtengo el id del nodo creado                   
                    ModeloRelaciones::crearRelacion($id_exp, $id_img, "Img");   //crea la relacion entre la experiencia y la imagen
                }
            }
            
            $band="true";
            
        break;
    
        case "editarExp":                                   
            
            $modelexperiencia = new ModelExperiencia();
            $query = "START n=node(".$_POST['experiencia'].") RETURN n";                        
            $resultado = $modelexperiencia->get_experiencias($query);            
            
            $band = array(
                "nombre"=> $resultado[0]->nombre,
                "descripcion"=> $resultado[0]->descripcion
            );
                                    
            $lista_imgs = $modelexperiencia->get_imagenes_experiencia($_POST['experiencia']);            
            //inserto el array de imagenes al array de las propiedades de la  experiencia
            array_push($band, $lista_imgs);                                                    
            
            //cambio el nombre que asigna la insertar el array de imagenes
            $band["imagenes"] = $band["0"];
            unset($band["0"]);
            
            //combierto el array en un json
            $band = json_encode($band);
            
        break;    

        case "guardar_edicionExp":                                                                      

            ModelExperiencia::editar_experiencia($_POST['experiencia'], "nombre", $_POST['titulo']);
            ModelExperiencia::editar_experiencia($_POST['experiencia'], "descripcion", $_POST['descripcion']);            
            $band="true";
            
        break;        

        case "eliminarExp":   

            $etiquetado=ModeloRelaciones::consultaNodosEtiquetadosEnRelacion($_POST['experiencia']); 
            $tipo_relacion="";
            
            //reviza si entre los etiquetados esta el usuario
            foreach($etiquetado as $row){

                    if($row==$_POST['usuario']){
                        $tipo_relacion="etiqueta";
                    }
                }

        
            if($tipo_relacion==""){

                //elimino la relacion entre la experiencia y las imagenes
                $modeloexperiencia = new ModelExperiencia();            

                // obtengo los id de las relaciones Img-Experiencia (Img), si existen las elimino
                $ids_relacionImgExp = ModelExperiencia::get_id_relaciones_nodo($_POST['experiencia'],"Img");

                if($ids_relacionImgExp){
                    ModelExperiencia::eliminar_relacion_experiencia($ids_relacionImgExp);     

                    // obtengo los id de los nodos de imagenes de la experiencia y luego las elimino            
                    $query = "START n=node(".$_POST['experiencia'].") MATCH n-[:Img]->i RETURN i;";
                    $ids_nodoImgExp = $modeloexperiencia->get_id_nodoImgExp($query);
                    ModelExperiencia::eliminar_nodos_ImgExp($ids_nodoImgExp);
                }

                // obtengo el id de la relacion Autor-Experiencia (Comparte), si existe la elimino
                $id_relacionUserExp = $modeloexperiencia->get_id_relaciones_nodo($_POST['experiencia'],"Comparte");
                if($id_relacionUserExp){
                    ModelExperiencia::eliminar_relacion_experiencia($id_relacionUserExp); 

                    // elimino el nodo de la experiencia
                    ModelExperiencia::eliminar_experiencia($_POST['experiencia']); //elimino el nodo de la experiencia                
                }
            }
            elseif($tipo_relacion=="etiqueta"){  //pregunta si es una Etiqueta
                //consulto el ID de la relacion                
                $idRelacion = ModeloRelaciones::consultarIDRelacion($_POST['experiencia'], $_POST['usuario'], "Etiqueta");  
                //elimina la relacion entre el usuario y la empresa                
                ModeloRelaciones::eliminarRelacion($idRelacion);   
            }    
           
            $band="true";
            
        break;    
    
    
        case "relacion_amigo":                       
            
            
        break;    

    
    
        case "seguir":  
  
            ModeloRelaciones::crearRelacion($_POST['seguidor'], $_POST['a_seguir'], "Amigo");   //crea la relacion de amistad            
            $band = 'true';
                        
        break;    
    
        case "no_seguir":  

            $idRelacion = ModeloRelaciones::consultarIDRelacion($_POST['seguidor'], $_POST['a_seguir'], "Amigo");  //consulto el ID de la relacion
           
            ModeloRelaciones::eliminarRelacion($idRelacion);   //elimina la relacion entre el usuario y la empresa
            $band = 'true';
            
        break;    
    

        case "eliminarImgExp":   

            //consulto el ID de la relacion                
            $idRelacion = ModeloRelaciones::consultarIDRelacion($_POST['experiencia'], $_POST['imagen'], "Img");  
            //elimina la relacion entre el usuario y la empresa                
            ModeloRelaciones::eliminarRelacion($idRelacion);   
                       
            //elimina la imagen
            ModelExperiencia::eliminar_nodos_ImgExp($_POST['imagen']);

            $band="true";
            
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