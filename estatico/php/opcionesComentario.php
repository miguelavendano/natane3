<?php
session_start();
require_once('../../core/coneccion.php');
require_once('../../core/modeloComentario.php');
require_once('../../core/modeloExperiencia.php');
require_once('../../core/modeloRelaciones.php');
require_once('../../core/modeloImagen.php');


if(isset($_POST['opcion'])){
    
    $band="false";
    $opcion=$_POST['opcion'];
            
    switch ($opcion){
       
        case "creaComentario":                       
            
            $nodo_comentario = new Comentario();
            $nodo_comentario->usuario = $_POST['autor'];
            $nodo_comentario->detalle = $_POST['comentario'];
            $nodo_comentario->fecha = date("d")." de ".date("F")." de ".date("Y")." a la(s) ".date("H:i");
            $nodo_comentario->type = 'Comentario';            
            ModelComentario::crearNodoComentario($nodo_comentario);
            
            $id_comen = $nodo_comentario->id;  //obtengo el id del nodo creado                                    
            ModeloRelaciones::crearRelacion($id_comen, $_POST['imagen'], "Sobre");   //crea la relacion entre el autor y la experiencia
           
            $band="true";
            
        break;
    
        case "editarComentario":            
            
            $query = "START n=node(".$_POST['comentario'].") RETURN n";                        
            $resultado = ModelComentario::get_comentario($query);
            
            $band = array(
                "detalle"=> $resultado[0]->detalle,
            );
                        
           $band = json_encode($band);
            
        break;    
  
        case "guardaEdicionComen":       
                   
            $fecha = date("d")." de ".date("F")." de ".date("Y")." a la(s) ".date("H:i");
            ModelComentario::editar_comentario($_POST['id_comen'], "detalle", $_POST['comentario']);
            ModelComentario::editar_comentario($_POST['id_comen'], "fecha", $fecha);            
            
            $band="true";
            
        break;        
/*
        case "eliminaComen":
            
            $etiquetado=ModeloRelaciones::consultaNodosEtiquetadosEnRelacion($_POST['experiencia']); 
            $tipo_relacion="";
            
            foreach($etiquetado as $row){
                    if($row==$_POST['empresa']){
                        $tipo_relacion="etiqueta";
                    }
                }
                
                
            if($tipo_relacion==""){

                // obtengo los id de las relaciones Img-Experiencia (Img), si existen las elimino                
                $ids_relacionImgExp = ModeloRelaciones::get_id_relaciones($_POST['experiencia'],"Img");

                if($ids_relacionImgExp){
                    //elimino la relacion entre la experiencia y las imagenes                    
                    ModeloRelaciones::eliminar_relaciones($ids_relacionImgExp);

                    // obtengo los id de los nodos de imagenes de la experiencia y luego las elimino                                
                    $ids_nodoImgExp = ModeloRelaciones::get_ids_imagenes_relacion('experiencia');
                    ModeloRelaciones::eliminar_nodos($ids_nodoImgExp);
                }

                // obtengo el id de la relacion Autor-Experiencia (Comparte), si existe la elimino
                $id_relacionUserExp = ModeloRelaciones::consultarIDRelacion($_POST['usuario'], $_POST['experiencia'], 'Comparte');
                
                if($id_relacionUserExp){
                    ModeloRelaciones::eliminarRelacion($id_relacionUserExp);
                    ModelExperiencia::eliminar_experiencia($_POST['experiencia']); //elimino el nodo de la experiencia                                                       
                }                
                                
            }
            elseif($tipo_relacion=="etiqueta"){  //pregunta si es una Etiqueta
                
                $idRelacion = ModeloRelaciones::consultarIDRelacion($_POST['experiencia'], $_POST['usuario'], "Etiqueta");  //consulto el ID de la relacion
                ModeloRelaciones::eliminarRelacion($idRelacion);   //elimina la relacion entre el usuario y la empresa                               
                //$band="etiqueta";
            }    
           
            $band="true";
            
        break;        
  */  
        default : break; 
    }    
    
    echo $band;
}

?>