<?php
session_start();
require_once('../../core/coneccion.php');
require_once('../../core/modeloEmpresa.php');
require_once('../../core/modeloExperiencia.php');
require_once('../../core/modeloRelaciones.php');
require_once('../../core/modeloServicio.php');
require_once('../../core/modeloImagen.php');



if(isset($_POST['opcion'])){
    
    $band="false";
    $opcion=$_POST['opcion'];
            
    switch ($opcion){

        // Registro de un Usuario
        case "registrarE":                      
            $nodo_empresa = new Empresa();
            $nodo_empresa->nombre = $_POST['RnomE'];            
            //$nodo_empresa->imagen = $img;
            $nodo_empresa->nit = $_POST['RnitE'];
            $nodo_empresa->descripcion = $_POST['RdesE'];
            $nodo_empresa->ciudad = $_POST['RcityE'];
            $nodo_empresa->telefono = $_POST['RtelE'];
            $nodo_empresa->direccion = $_POST['RdirE'];   
            $nodo_empresa->latitud = "4.15";
            $nodo_empresa->longitud = "-73.64";
            $nodo_empresa->correo = $_POST['RmailE'];
            $nodo_empresa->sitio_web = $_POST['RwebE'];    
            $nodo_empresa->facebook = $_POST['RfaceE'];
            $nodo_empresa->twitter = $_POST['RtwiE'];
            $nodo_empresa->youtube = $_POST['RyouE'];
            //$nodo_empresa->contraseña = $_SESSION['clave'];
            $nodo_empresa->type = 'Empresa';
            ModelEmpresa::crearNodoEmpresa($nodo_empresa); //crea el nodo del Usuario 
                        
            $band=$nodo_empresa->id;  //obtengo el id del nodo creado
            
            
            ModeloRelaciones::crearRelacion($_SESSION['id'], $nodo_empresa->id, "Crea");   //crea la relacion entre el usuario y la empresa que ha visitado                                   

            
            $upload_folder ='../../estatico/imagenes/';
            
            foreach($_FILES['img-empresa']['error'] as $key => $error){                
                if($error == UPLOAD_ERR_OK){                    
                    $nombre_archivo = $_FILES['img-empresa']['name'][$key];
                    $tmp_archivo = $_FILES['img-empresa']['tmp_name'][$key];            
                    //$tipo_archivo = $_FILES['foto_perfil']['type'][$key];
                    //$tamano_archivo = $_FILES['foto_perfil']['size'][$key];

                    $nomFotoPerfil = $nodo_empresa->id.'_'.$nombre_archivo;
                    
                    move_uploaded_file($tmp_archivo, $upload_folder.$nomFotoPerfil);   //guarda la imagen                    
                    
                    ModelEmpresa::editar_empresa($nodo_empresa->id, "imagen", $nomFotoPerfil);                                         
                }
            }
            
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
            ModelEmpresa::editar_empresa($_POST['empresa'], "sitio_web", $_POST['s_web']);
            ModelEmpresa::editar_empresa($_POST['empresa'], "facebook", $_POST['face']);
            ModelEmpresa::editar_empresa($_POST['empresa'], "twitter", $_POST['twit']);
            ModelEmpresa::editar_empresa($_POST['empresa'], "youtube", $_POST['youtube']);
            ModelEmpresa::editar_empresa($_POST['empresa'], "contraseña", $_POST['pass']);
            //ModelEmpresa::editar_empresa($_POST['usuario'], "imagen", );    
            
            if(count($_POST['lat_lon'])>0){
                ModelEmpresa::editar_empresa($_POST['empresa'], "latitud", $_POST['lat_lon']['latitud']);
                ModelEmpresa::editar_empresa($_POST['empresa'], "longitud", $_POST['lat_lon']['longitud']);
            }
            
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
                     
            ModeloRelaciones::crearRelacion($_SESSION['id'], $_POST['empresa'], "Cliente");   //crea la relacion entre el usuario y la empresa
            
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

            $idRelacion = ModeloRelaciones::consultarIDRelacion($_SESSION['id'], $_POST['empresa'], "Cliente");  //consulto el ID de la relacion
            
            ModeloRelaciones::eliminarRelacion($idRelacion);   //elimina la relacion entre el usuario y la empresa
            
            $html = "<a class='btn btn-cyan active btn-block'>
                        <h4>$puntos Puntos de Confianza</h4>
                    </a>";
            
            $band="";
            $band=$html;
            
        break;    
  
        case "editaExpEmp":                       
            
            $modelexperiencia = new ModelExperiencia();
            $query = "START n=node(".$_POST['experiencia'].") RETURN n";                        
            $resultado = $modelexperiencia->get_experiencias($query);            
            
            $info = array(
                "nombre"=> $resultado[0]->nombre,
                "descripcion"=> $resultado[0]->descripcion
            );
                                    
            $lista_imgs = $modelexperiencia->get_imagenes_experiencia($_POST['experiencia']);            
            //inserto el array de imagenes al array de las propiedades de la  experiencia
            array_push($info, $lista_imgs);                                                    
            
            //cambio el nombre que asigna la insertar el array de imagenes
            $info["imagenes"] = $info["0"];
            unset($info["0"]);
            
            //combierto el array en un json
            $band = json_encode($info);
           
            
        break;    

        case "guardar_edicionExpEmp":                                                                      

            ModelExperiencia::editar_experiencia($_POST['servicio'], "nombre", $_POST['titulo']);
            ModelExperiencia::editar_experiencia($_POST['servicio'], "descripcion", $_POST['descripcion']);            
            $band="true";
            
        break;        

        case "eliminaExpEmp":
            
            $etiquetado=ModeloRelaciones::consultaNodosEtiquetadosEnRelacion($_POST['experiencia']); 
            $tipo_relacion="";
            
            foreach($etiquetado as $row){
                    if($row==$_POST['empresa']){
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
                $id_relacionUserExp = ModeloRelaciones::consultarIDRelacion($_POST['empresa'], $_POST['experiencia'], 'Comparte');
                
                if($id_relacionUserExp){
                    ModeloRelaciones::eliminarRelacion($id_relacionUserExp);
                    ModelExperiencia::eliminar_experiencia($_POST['experiencia']); //elimino el nodo de la experiencia                                                       
                }                
                                
            }
            elseif($tipo_relacion=="etiqueta"){  //pregunta si es una Etiqueta
                
                $idRelacion = ModeloRelaciones::consultarIDRelacion($_POST['experiencia'], $_POST['empresa'], "Etiqueta");  //consulto el ID de la relacion
                ModeloRelaciones::eliminarRelacion($idRelacion);   //elimina la relacion entre el usuario y la empresa                               
                //$band="etiqueta";
            }    
           
            $band="true";
            
        break;        
        
        case "creaServicio":
            
            //echo $_POST['precioSer'];
            $nodo_servicio = new Servicio();
            $nodo_servicio->nombre = $_POST['nomSer'];
            $nodo_servicio->descripcion = $_POST['descSer'];
            $nodo_servicio->type = 'Servicio';            
            ModelServicio::crearNodoServicio($nodo_servicio);
            
            $id_servicio = $nodo_servicio->id;  //obtengo el id del nodo creado                                    
            ModeloRelaciones::crearRelacion($_POST['empresa'], $id_servicio, "Ofrece");   //crea la relacion entre la empresa y el servicio
            
            $cont=1;
            //guarda la imagen de la experiencia
            $upload_folder ='../../estatico/imagenes/';
            foreach($_FILES['imagen_servicio']['error'] as $key => $error){                
                if($error == UPLOAD_ERR_OK){                    
                    //alamaceno la imagen
                    $nombre_archivo = $_FILES["imagen_servicio"]['name'][$key];
                    $tmp_archivo = $_FILES["imagen_servicio"]['tmp_name'][$key];            

                    //creo el nombre unico para la imagen
                    $nomImgServiEmp = $_POST['empresa'].'_'.$id_servicio.'_'.$cont.'_'.$nombre_archivo;
                    
                    //crea el nodo de cada una de las imagenes
                    $nodo_imagen = new Imagen();
                    $nodo_imagen->nombre = $nomImgServiEmp;
                    $nodo_imagen->descripcion = "";
                    $nodo_imagen->type = 'Imagen';  
                    ModelImagen::crearNodoImagen($nodo_imagen);  //crea el nodo de la imagen

                    $id_img = $nodo_imagen->id;  //obtengo el id del nodo creado                   
                    ModeloRelaciones::crearRelacion($id_servicio, $id_img, "Img");   //crea la relacion entre la experiencia y la imagen
                    
                    //almaceno la imagen en la carpeta del servidor                                        
                    move_uploaded_file($tmp_archivo, $upload_folder.$nomImgServiEmp);   //guarda la imagen                    
                    $cont++;
                }
            }
            
            $band="true";
            
        break;        
    
        case "editarServicio":                       
            
            $modelservicio = new ModelServicio();
            $query = "START n=node(".$_POST['servicio'].") RETURN n";                        
            $resultado = $modelservicio->get_servicio($query);            
            
            $band = array(
                "nombre"=> $resultado[0]->nombre,
                "descripcion"=> $resultado[0]->descripcion
            );
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

        case "guardaEdicionServicio":                                                                      

            ModelServicio::editar_servicio($_POST['servicio'], "nombre", $_POST['nombre']);
            ModelServicio::editar_servicio($_POST['servicio'], "descripcion", $_POST['descripcion']);            
            $band="true";
            
        break;      
    
        case "eliminarServicio":

                // obtengo los id de las imagenes del servicio
                $ids_nodoImgSer = ModeloRelaciones::get_ids_nodos_relacion($_POST['servicio'],"Img");

                //reviso si las imagenes tienen comentarios, si es asi los elimina
                foreach($ids_nodoImgSer as $row){                        

                    // obtengo los id de las relaciones Img-Comentario (Sobre), si existen las elimino                
                    $ids_relacionImgSer = ModeloRelaciones::get_id_relaciones($row,"Img");                        

                    if($ids_relacionImgSer){                            
                        //elimino la relacion entre el servicio y su imagen
                        ModeloRelaciones::eliminar_relaciones($ids_relacionImgSer);                        
                        // obtengo los id las imagenes del servicio
                        $ids_nodoImgComen = ModeloRelaciones::get_ids_nodos_relacion($row,"Img");
                        //elimino las imagenes del servicio
                        ModeloRelaciones::eliminar_nodos($ids_nodoImgComen);                        
                    }
                }            
                
                // obtengo el id de la relacion Empresa-Servicio (Ofrece)
                $id_relacionEmpSer = ModeloRelaciones::consultarIDRelacion($_POST['empresa'], $_POST['servicio'], 'Ofrece');           
                
                if($id_relacionEmpSer){
                    ModeloRelaciones::eliminarRelacion($id_relacionEmpSer);                                
                    ModelServicio::eliminarServicio($_POST['servicio']);
                    $band="true";
                }                                
            
        break;          
        
        case "obtieneCoordenadasE":                       
                    
            $modelempresa = new ModelEmpresa();
            $query = "START n=node(".$_POST['sitio'].") RETURN n";                        
            $resultado = $modelempresa->get_empresa($query);
                       
            $band = array(
                "automatico"=>false,
                "drag" =>true,                
                "lat" => $resultado[0]->latitud,
                "lon" => $resultado[0]->longitud,
                "idMapa" => "MapaPerfil"
            );
            
           $band = json_encode($band);
            
        break;                
    
        default : break; 
    }    
    
    echo $band;
}

?>