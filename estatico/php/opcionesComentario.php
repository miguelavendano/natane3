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
        default : break; 
    }    
    
    echo $band;
}

?>