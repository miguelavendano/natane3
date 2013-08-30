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
        case "registrarU":                       

            $nodo_usuario = new Usuario();
            $nodo_usuario->nombre = $_POST['nombre'];
            $nodo_usuario->apellido = $_POST['apellido'];            
            $nodo_usuario->genero = $_POST['genero'];
            $nodo_usuario->fecha_nacimiento = $_POST['nacimiento'];
            $nodo_usuario->correo = $_POST['mail'];
            $nodo_usuario->imagen = $img;            
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
/*
        case "guardar_edicionU":       
            
            $upload_folder ='../../estatico/imagenes/';
            foreach($_FILES['foto_perfil']['error'] as $key => $error){                
                if($error == UPLOAD_ERR_OK){                    
                    $nombre_archivo = $_FILES['foto_perfil']['name'][$key];
                    $tmp_archivo = $_FILES['foto_perfil']['tmp_name'][$key];            
                    //$tipo_archivo = $_FILES['foto_perfil']['type'][$key];
                    //$tamano_archivo = $_FILES['foto_perfil']['size'][$key];

                    //echo $nombre_archivo;
                    $nomFotoPerfil = $_POST['usuario'].'_'.$nombre_archivo;
                    echo $nomFotoPerfil;

                    move_uploaded_file($tmp_archivo, $upload_folder.$nomFotoPerfil);   //guarda la imagen
                }
            }            
                                
            ModelUsuarios::editar_usuario($_POST['usuario'], "nombre", $_POST['EnomU']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "apellido", $_POST['EapeU']);            
            ModelUsuarios::editar_usuario($_POST['usuario'], "imagen", $nomFotoPerfil);         
            ModelUsuarios::editar_usuario($_POST['usuario'], "nick", $_POST['EnickU']);            
            ModelUsuarios::editar_usuario($_POST['usuario'], "genero",$_POST['EgeneroU']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "fecha_nacimiento", $_POST['EnaciU']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "ciudad_origen", $_POST['EcityU']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "lugar_recidencia", $_POST['ErecideU']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "correo", $_POST['EmailU']); 
            ModelUsuarios::editar_usuario($_POST['usuario'], "sitio_web", $_POST['Es_webU']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "facebook", $_POST['EfaceU']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "twitter", $_POST['EtwiU']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "youtube", $_POST['EyouU']);
            ModelUsuarios::editar_usuario($_POST['usuario'], "contraseña", $_POST['Epass1U']);
            
            $band="true";
            
        break;      
*/
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
                    echo $nomFotoPerfil;

                    move_uploaded_file($tmp_archivo, $upload_folder.$nomFotoPerfil);   //guarda la imagen
                }
            }            
            
            ModelUsuarios::editar_usuario($_POST['usuario'], "imagen", $nomFotoPerfil);         
            
            $band="true";
            
        break;        
        
        case "experiencia":                       

            echo $_POST['Exptitulo'];
            echo $_POST['Expdesc'];
            
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
                    $nodo_imagen->comentario1 = "";
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
                        
           $band = json_encode($band);
            
        break;    

        case "guardar_edicionExp":                                                                      

            ModelExperiencia::editar_experiencia($_POST['experiencia'], "nombre", $_POST['titulo']);
            ModelExperiencia::editar_experiencia($_POST['experiencia'], "descripcion", $_POST['descripcion']);            
            $band="true";
            
        break;        

        case "eliminarExp":   
            
            //elimino la relacion entre la experiencia y las imagenes
            $modeloexperiencia = new ModelExperiencia();            
            
            // obtengo los id de las relaciones Img-Experiencia (Img), si existen las elimino
            $ids_relacionImgExp = $modeloexperiencia->get_id_relaciones_nodo($_POST['experiencia'],"Img");
            
            if($ids_relacionImgExp){
                $modeloexperiencia->eliminar_relacion_experiencia($ids_relacionImgExp);     
                
                // obtengo los id de los nodos de imagenes de la experiencia y luego las elimino            
                $query = "START n=node(".$_POST['experiencia'].") MATCH n-[:Img]->i RETURN i;";
                $ids_nodoImgExp = $modeloexperiencia->get_id_nodoImgExp($query);
                $modeloexperiencia->eliminar_nodos_ImgExp($ids_nodoImgExp);
            }
                        
            // obtengo el id de la relacion Autor-Experiencia (Comparte), si existe la elimino
            $id_relacionUserExp = $modeloexperiencia->get_id_relaciones_nodo($_POST['experiencia'],"Comparte");
            if($id_relacionUserExp){
                $modeloexperiencia->eliminar_relacion_experiencia($id_relacionUserExp); 

                // elimino el nodo de la experiencia
                ModelExperiencia::eliminar_experiencia($_POST['experiencia']); //elimino el nodo de la experiencia                
            }
           
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