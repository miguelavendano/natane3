<?php
session_start();
require_once('../../core/coneccion.php');
require_once('../../core/modeloUsuario.php');
require_once('../../core/modeloExperiencia.php');
require_once('../../core/modeloRelaciones.php');
require_once('../../core/modeloImagen.php');


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
//            $mysql = new Conexion();
//            
//            
//            $sql = "INSERT INTO usuario (
//                        email,
//                        idfacebook,
//                        idneo4j,
//                        password
//                    )VALUES(
//                        '".$_POST['mail']."',
//                        '12345678',
//                        '".$band."',
//                        '".$_POST['contra1']."'
//                    );";
//            
//            $mysql->ejecutar_query($sql);
//            
//            
//            $band=$band." true";
            
            
            
            
        break;
    
        case "editarU":                       
            
            $modelusuarios = new ModelUsuarios();            
            $query = "START n=node(".$_SESSION['id'].") RETURN n";            
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
                   
            ModelUsuarios::editar_usuario($_SESSION['id'], "nombre", $_POST['nombre']);
            ModelUsuarios::editar_usuario($_SESSION['id'], "apellido", $_POST['apellido']);            
            ModelUsuarios::editar_usuario($_SESSION['id'], "nick", $_POST['nick']);            
            ModelUsuarios::editar_usuario($_SESSION['id'], "genero",$_POST['genero']);
            ModelUsuarios::editar_usuario($_SESSION['id'], "fecha_nacimiento", $_POST['f_nace']);
            ModelUsuarios::editar_usuario($_SESSION['id'], "ciudad_origen", $_POST['city']);
            ModelUsuarios::editar_usuario($_SESSION['id'], "lugar_recidencia", $_POST['recide']);
            ModelUsuarios::editar_usuario($_SESSION['id'], "correo", $_POST['mail']); 
            ModelUsuarios::editar_usuario($_SESSION['id'], "sitio_web", $_POST['s_web']);
            ModelUsuarios::editar_usuario($_SESSION['id'], "facebook", $_POST['face']);
            ModelUsuarios::editar_usuario($_SESSION['id'], "twitter", $_POST['twit']);
            ModelUsuarios::editar_usuario($_SESSION['id'], "youtube", $_POST['youtube']);
            ModelUsuarios::editar_usuario($_SESSION['id'], "contraseña", $_POST['pass']);
            
            $_SESSION['nick'] = $_POST['nick'];
            
            
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
                    $nomFotoPerfil = $_SESSION['id'].'_'.$nombre_archivo;
                    
                    move_uploaded_file($tmp_archivo, $upload_folder.$nomFotoPerfil);   //guarda la imagen
                    
                    $_SESSION['img'] = $nomFotoPerfil;
                }
            }            
            
            ModelUsuarios::editar_usuario($_SESSION['id'], "imagen", $nomFotoPerfil);         
            
            $band="true";
            
        break;        
        
        case "crea_experiencia":                       
            
            $nodo_experiencia = new Experiencia();
            $nodo_experiencia->nombre = $_POST['Exptitulo'];
            $nodo_experiencia->descripcion = $_POST['Expdesc'];
            $nodo_experiencia->type = 'Experiencia';            
            ModelExperiencia::crearNodoExperiencia($nodo_experiencia);  //crea el nodo de la experiencia
            
            $id_exp = $nodo_experiencia->id;  //obtengo el id del nodo creado                                    
            ModeloRelaciones::crearRelacion($_SESSION['id'], $id_exp, "Comparte");   //crea la relacion entre el autor y la experiencia
            ModeloRelaciones::crearRelacion($id_exp, $_POST['sitio'], "Asociada");   //crea la relacion entre la experiencia y elsitio
            
            //guarda las imagenes de la experiencia
            $upload_folder ='../../estatico/imagenes/';
            foreach($_FILES['imagenes_experiencia']['error'] as $key => $error){                
                if($error == UPLOAD_ERR_OK){                    
                    //alamaceno la imagen
                    $nombre_archivo = $_FILES["imagenes_experiencia"]['name'][$key];
                    $tmp_archivo = $_FILES["imagenes_experiencia"]['tmp_name'][$key];            
                    //$tipo_archivo = $_FILES["imagenes_experiencia"]['type'][$key];
                    //$tamano_archivo = $_FILES["imagenes_experiencia"]['size'][$key];

                    //creo el nombre unico para la imagen
                    $nomImgExpUser = $_SESSION['id'].'_'.$id_exp.'_'.$nombre_archivo;
                    
                    //crea el nodo de cada una de las imagenes
                    $nodo_imagen = new Imagen();
                    $nodo_imagen->nombre = $nomImgExpUser;
                    $nodo_imagen->descripcion = "";
                    $nodo_imagen->type = 'Imagen';  
                    ModelImagen::crearNodoImagen($nodo_imagen);  //crea el nodo de la imagen

                    $id_img = $nodo_imagen->id;  //obtengo el id del nodo creado                   
                    ModeloRelaciones::crearRelacion($id_exp, $id_img, "Img");   //crea la relacion entre la experiencia y la imagen
                    
                    //almaceno la imagen en la carpeta del servidor                                        
                    move_uploaded_file($tmp_archivo, $upload_folder.$nomImgExpUser);   //guarda la imagen                    
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
            
            /*
            ModelExperiencia::editar_experiencia($_POST['experiencia'], "nombre", $_POST['titulo']);
            ModelExperiencia::editar_experiencia($_POST['experiencia'], "descripcion", $_POST['descripcion']);            
            */
            
            ModelExperiencia::editar_experiencia($_POST['experiencia'], "nombre", $_POST['ediExpTitulo']);
            ModelExperiencia::editar_experiencia($_POST['experiencia'], "descripcion", $_POST['ediExpDesc']);            
            
            //guarda las imagenes de la experiencia            
            $upload_folder ='../../estatico/imagenes/';
            foreach($_FILES['imgs_edit_experiencia']['error'] as $key => $error){                
                if($error == UPLOAD_ERR_OK){                    
                    //alamaceno la imagen
                    $nombre_archivo = $_FILES["imgs_edit_experiencia"]['name'][$key];
                    $tmp_archivo = $_FILES["imgs_edit_experiencia"]['tmp_name'][$key];            

                    //creo el nombre unico para la imagen
                    $nomImgExpUser = $_SESSION['id'].'_'.$id_exp.'_'.$nombre_archivo;                    
                    
                    //crea el nodo de cada una de las imagenes                    
                    $nodo_newImgExp = new Imagen();
                    $nodo_newImgExp->nombre = $nomImgExpUser;
                    $nodo_newImgExp->descripcion = "";
                    $nodo_newImgExp->type = 'Imagen';  
                    ModelImagen::crearNodoImagen($nodo_newImgExp);  //crea el nodo de la imagen

                    $id_img = $nodo_imagen->id;  //obtengo el id del nodo creado                   
                    ModeloRelaciones::crearRelacion($id_exp, $id_img, "Img");   //crea la relacion entre la experiencia y la imagen

                    //almaceno la imagen en la carpeta del servidor                                        
                    move_uploaded_file($tmp_archivo, $upload_folder.$nomImgExpUser);   //guarda la imagen                    
                }
            }
            
            $band="true";
            
        break;        

        case "eliminarExp":
                        
            $etiquetado=ModeloRelaciones::consultaNodosEtiquetadosEnRelacion($_POST['experiencia']); 
            $tipo_relacion="";
            
            foreach($etiquetado as $row){
                    if($row==$_SESSION['id']){
                        $tipo_relacion="etiqueta";
                    }
                }
                
            if($tipo_relacion==""){

                // obtengo los id de las relaciones Experiencia-Sitio (Asociada), si existen las elimino
                $ids_relacionImgEmp = ModeloRelaciones::get_id_relaciones($_POST['experiencia'],"Asociada");                
                if($ids_relacionImgEmp){
                    //elimino la relacion entre la experiencia y las empresas
                    ModeloRelaciones::eliminar_relaciones($ids_relacionImgEmp);    
                }
                
                // obtengo los id de las relaciones Img-Experiencia (Img), si existen las elimino                
                $ids_relacionImgExp = ModeloRelaciones::get_id_relaciones($_POST['experiencia'],"Img");

                if($ids_relacionImgExp){

                    // obtengo los id de los nodos vinculados al nodo dado segun su relacion
                    $ids_nodoImgExp = ModeloRelaciones::get_ids_nodos_relacion($_POST['experiencia'],"Img");

                    //reviso si las imagenes tienen comentarios, si es asi los elimina
                    foreach($ids_nodoImgExp as $row){                        

                        // obtengo los id de las relaciones Img-Comentario (Sobre), si existen las elimino                
                        $ids_relacionImgComen = ModeloRelaciones::get_id_relaciones($row,"Sobre");                        

                        if($ids_relacionImgComen){                            
                            //elimino la relacion entre la imagen y sus comentarios
                            ModeloRelaciones::eliminar_relaciones($ids_relacionImgComen);                        
                            // obtengo los id de los nodos vinculados al nodo dado segun su relacion
                            $ids_nodoImgComen = ModeloRelaciones::get_ids_nodos_relacion($row,"Sobre");
                            //elimino las imagenes de la experiencia
                            ModeloRelaciones::eliminar_nodos($ids_nodoImgComen);                        
                        }
                    }
                    
                    //elimino la relacion entre la experiencia y las imagenes                    
                    ModeloRelaciones::eliminar_relaciones($ids_relacionImgExp);                        
                    //elimino las imagenes de la experiencia
                    ModeloRelaciones::eliminar_nodos($ids_nodoImgExp);
                }
                
                // obtengo el id de la relacion Autor-Experiencia (Comparte), si existe la elimino
                $id_relacionUserExp = ModeloRelaciones::consultarIDRelacion($_SESSION['id'], $_POST['experiencia'], 'Comparte');
                
                if($id_relacionUserExp){
                    ModeloRelaciones::eliminarRelacion($id_relacionUserExp);
                    ModelExperiencia::eliminar_experiencia($_POST['experiencia']); //elimino el nodo de la experiencia                                                       
                }                
                                
            }
            elseif($tipo_relacion=="etiqueta"){  //pregunta si es una Etiqueta
                
                $idRelacion = ModeloRelaciones::consultarIDRelacion($_POST['experiencia'], $_SESSION['id'], "Etiqueta");  //consulto el ID de la relacion
                ModeloRelaciones::eliminarRelacion($idRelacion);   //elimina la relacion entre el usuario y la empresa                               
                //$band="etiqueta";
            }    
           
            $band="true";
            
        break;    
   
    
        case "seguir":  
  
            ModeloRelaciones::crearRelacion($_SESSION["id"], $_POST['a_seguir'], "Amigo");   //crea la relacion de amistad            
            $band = 'true';
                        
        break;    
    
        case "no_seguir":  

            $idRelacion = ModeloRelaciones::consultarIDRelacion($_SESSION["id"], $_POST['a_seguir'], "Amigo");  //consulto el ID de la relacion
            ModeloRelaciones::eliminarRelacion($idRelacion);   //elimina la relacion entre el usuario y la empresa
            $band = 'true';
            
        break;        

        case "eliminarImgExp":   
            
            $idRelacion = ModeloRelaciones::consultarIDRelacion($_POST['experiencia'], $_POST['imagen'], "Img");  
            ModeloRelaciones::eliminarRelacion($idRelacion);                          
            ModelExperiencia::eliminar_nodos_ImgExp($_POST['imagen']);

            $band="true";        
            
        break;    
    
        case "login":                                                                      

            $modelusuarios = new ModelUsuarios();            
            $query = "SELECT idneo4j, email, password FROM natane.usuario WHERE email = '".$_SESSION['id']."';";                     
            $mysql = new Conexion();            
            $resultado = $mysql->get_resultados_query($query);
            
//            echo $resultado[0]->id."  --  ";            
//            echo $resultado[0]->correo."  --  ";
//            echo $resultado[0]->contraseña."  --  ";
                  
            
            $_SESSION["id"] = $resultado[0]['idneo4j'];
            echo $resultado[0]['idneo4j'];
            
            if($_SESSION['id'] == $resultado[0]['email'] && $_POST['clave'] == $resultado[0]['password']){
                
               // $band=$_SESSION["id"];
                $band = $band." true";
            }
            else {
                ///$band=" false";
            }            
            
        break;    
    
        default : break; 
    }    
    
    echo $band;
}

?>