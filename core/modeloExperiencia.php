<?php

require_once('coneccion.php');
require_once('Experiencia.php');
require_once('Imagen.php');
//require_once('Usuario.php');


use Everyman\Neo4j\Node,
    Everyman\Neo4j\Index,
    Everyman\Neo4j\Query\ResultSet,
    Everyman\Neo4j\Relationship,
    Everyman\Neo4j\Cypher,
    Everyman\Neo4j\Cypher\Query,
    Everyman\Neo4j\Command,
    Everyman\Neo4j\Query\Row;


class ModelExperiencia{
    
        public function __construct() {
            
        }
        
        
        /**
         * funcion para crear el nodo tipo Experiencia
         * parametros: objeto tipo Experiencia
         */	
	public static function crearNodoExperiencia(Experiencia $minodo)
	{
		if (!$minodo->node) {
			$minodo->node = new Node(Neo4Play::client());
		}

		$minodo->node->setProperty('nombre', $minodo->nombre)
				->setProperty('descripcion', $minodo->descripcion)
                                ->setProperty('type', $minodo->type)
				->save();              
                
                
		$minodo->id = $minodo->node->getId();                

		$minodoIndex = new Index(Neo4Play::client(), Index::TypeNode,'Experiencia');
		$minodoIndex->add($minodo->node, 'nombre', $minodo->nombre);
                
	}  

        /*
         * Funcion que edita una propiedad de una experiencia y si no existe la crea
         */        
	public static function editar_experiencia($idnodo, $propiedad, $detalle){
		//Obtengo toda la informacion del nodo
		$editar = Neo4Play::client()->getNode($idnodo);
		//edita la propiedad y si no existe la crea
		$editar->setProperty($propiedad,$detalle)
		    	->save();
	}              

        /*
         * Elimina el nodo de una experiencia
         */
	public static function eliminar_experiencia($idnodo){
            $eliminar = Neo4Play::client()->getNode($idnodo);		
            $eliminar->delete();			    	
	}

       
        /*
         * Obtine las experiencias de un usuario
         */                
        public static function get_exper_usuario($queryString){
                        
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();
            
            $array = array();
         
            
            if($result){
            
                $imagenes="";
                foreach($result as $row) {
                    $experiencia = new Experiencia();
                    $experiencia->id = $row['']->getId();
                    $experiencia->nombre = $row['']->getProperty('nombre');
                    $experiencia->descripcion = $row['']->getProperty('descripcion');
                                        
                    //consulto imagenes de la experiencia
                    $query = "START n=node(".$experiencia->id.") MATCH n-[:Img]->i RETURN i.nombre;";                    
                    $queryRes = new Cypher\Query(Neo4Play::client(), $query);      
                    
                    $resImg = $queryRes->getResultSet();
                    
                    if($resImg){
                        
                        if(count($resImg)>0){
                            $img_ran = rand (0, count($resImg)-1);   //elemento aleatorio de las imagenes de la experiencia

                            foreach($resImg as $img){                            
                                $imagenes[]=$img[''];                            
                            }

                            $experiencia->imagen = $imagenes[$img_ran];  //almacena la imagen aleatorio para mostrarla en la vista
                            $imagenes="";        
                        }
                        else {
                            $experiencia->imagen= "experiencia_sin_foto.png";  //si la experienci no tiene imagen muestra esta por defecto
                        }                        
                    }
                    
                    //consulta el id del sitio relacionado a la experiencia
                    $query = "START e=node(".$experiencia->id.") MATCH e-[:Asociada]->s RETURN s";
                    $queryRes2 = new Cypher\Query(Neo4Play::client(), $query);                          
                    $resSitio = $queryRes2->getResultSet();
                    
                    if($resSitio){     
                        
                        foreach($resSitio as $row) {                                                                       
                            //$experiencia->id_sitio = $row['id'];
                            //$experiencia->nombre_sitio = $row['nombre'];
                            //echo $row['']->getId(); 
                            //echo $row['']->getProperty('nombre');
                             $experiencia->id_sitio = $row['']->getId();
                             $experiencia->nombre_sitio = $row['']->getProperty('nombre');
                        }         
                    }
                    
                    array_push($array, $experiencia);
                    $res=null;
                    $resSitio=null;
                    $resImg=null;
                }
                return $array;
            }
        }        

       
        /*
         * Obtine las experiencias de una empresa o sitio
         */                
        public static function get_experiencias($queryString){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();            
            $array = array();
            
            if($result){

                foreach($result as $row) {
                    $experiencia = new Experiencia();
                    $experiencia->id = $row['']->getId();
                    $experiencia->nombre = $row['']->getProperty('nombre');
                    $experiencia->descripcion = $row['']->getProperty('descripcion');                    
                    
                    $query = "START n=node(".$experiencia->id.") MATCH n-[:Img]->i RETURN i.nombre;";                    
                    $queryRes = new Cypher\Query(Neo4Play::client(), $query);      
                    
                    if($queryRes){
                        
                        $res = $queryRes->getResultSet();                                                                
                        //$experiencia->imagen= $res[0]->offsetGet('');                        
                        
                        if(count($res)>0){
                            $img_ran = rand (0, count($res)-1);   //elemento aleatorio de las imagenes de la experiencia

                            foreach($res as $img){                            
                                $imagenes[]=$img[''];                            
                            }

                            $experiencia->imagen = $imagenes[$img_ran];  //almacena la imagen aleatorio para mostrarla en la vista
                            $imagenes="";        
                        }
                        else {
                            $experiencia->imagen= "experiencia_sin_foto.png";  //si la experienci no tiene imagen muestra esta por defecto
                        }                        
                    }
                    
                    //consulta el id del sitio relacionado a la experiencia
                    $query = "START e=node(".$experiencia->id.") MATCH e<-[:Comparte]-u RETURN u";
                    $queryRes2 = new Cypher\Query(Neo4Play::client(), $query);                          
                    $resSitio = $queryRes2->getResultSet();
                    
                    if($resSitio){     
                        
                        foreach($resSitio as $row) {                                                                       
                            //$experiencia->id_sitio = $row['id'];
                            //$experiencia->nombre_sitio = $row['nombre'];
                            //echo $row['']->getId(); 
                            //echo $row['']->getProperty('nombre');
                             $experiencia->id_usuario = $row['']->getId();
                             $experiencia->nick_usuario = $row['']->getProperty('nick');
                        }         
                    }
                    
                    array_push($array, $experiencia);
                    $res=null;
                }
                return $array;
            }
        }        
        
        
        /*
         * Obtine todas las imagenes de una experiencia
         */                
        public static function get_imagenes_experiencia($id_experiencia){                    
            
                    $queryString = "START n=node(".$id_experiencia.") MATCH n-[:Img]->i RETURN i";                    
                    $queryRes = new Cypher\Query(Neo4Play::client(), $queryString);      
                    $imagenes = $queryRes->getResultSet();                   
                    $lis_imagenes = array();
                    
                    if(count($imagenes)){
                        foreach($imagenes as $img) {                                                                    
                            $img_nombre = $img['']->getProperty('nombre');
                            $img_id = $img['']->getId();                        

                            //almaceno las imagenes
                            $retorno = array(                            
                                'img_nombre'=>$img_nombre,
                                'img_id'=>$img_id,                            
                                );

                            array_push($lis_imagenes, $retorno);                                                    
                        }
                    }
                    
            return $lis_imagenes;
        }


        /*
         * Obtine todas las imagenes de una galeria ya sea de Sitio o Empresa
         */         
        public static function get_imagenes_galeria($queryString){
                       
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $imagen = $query->getResultSet();                                  
            
            $img_galeria = array();

            foreach($imagen as $img) {                    
                
                $query = "START n=node(".$img['']->getId().") MATCH n<-[:Img]-e<-[:Comparte]-u RETURN u";
                $queryRes = new Cypher\Query(Neo4Play::client(), $query);                          
                $usuario = $queryRes->getResultSet();                    
                
                    $img_nombre = $img['']->getProperty('nombre');
                    $img_id = $img['']->getId();
                    $id_usuario=$usuario[0]['']->getId();
                    $img_usuario=$usuario[0]['']->getProperty('imagen'); 
                    $type = "";
                    
                    if($usuario[0]['']->getProperty('type') == "Empresa"){ //valida si es una empresa o un usuario el dueño de esta imagen
                        $nick_usuario=$usuario[0]['']->getProperty('nombre');                
                        $type="Empresa";
                    }else{
                        $nick_usuario=$usuario[0]['']->getProperty('nick');                
                        $type="Usuario";
                    }
                    
                $retorno = array(
                    'type'=>$type,
                    'img_nombre'=>$img_nombre,
                    'img_id'=>$img_id,
                    'usuario_id'=>$id_usuario,
                    'usuario_img'=>$img_usuario,
                    'usuario_nick'=>$nick_usuario
                    );


                array_push($img_galeria, $retorno);
            }    
            return $img_galeria;                      
        }


        /*
         * Obtine todas las imagenes de una galeria ya sea de Sitio o Empresa
         */                 
        public static function get_comentarios_imagen($queryString){
                                        
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $comentarios = $query->getResultSet();                                              
            $lis_comentarios = array();

            foreach($comentarios as $com) {                    
                
                $query = "START u=node(".$com['']->getProperty('usuario').") RETURN u";
                $queryRes = new Cypher\Query(Neo4Play::client(), $query);                          
                $usuario = $queryRes->getResultSet();                    
                
                    $id_usuario = $com['']->getProperty('usuario');
                    $detalle = $com['']->getProperty('detalle');
                    $fecha = $com['']->getProperty('fecha');
                    $id_comentario = $com['']->getId();
                    
                    //$id_usuariod=$usuario[0]['']->getId();
                    $img_usuario=$usuario[0]['']->getProperty('imagen'); 
                    $type = "";
                    
                    if($usuario[0]['']->getProperty('type') == "Empresa"){ //valida si es una empresa o un usuario el dueño de esta imagen
                        $nick_usuario=$usuario[0]['']->getProperty('nombre');                
                        $type="Empresa";
                    }else{
                        $nick_usuario=$usuario[0]['']->getProperty('nick');  
                        $type="Usuario";
                    }
                    
                    $retorno = array(
                        'type'=>$type,
                        'id_usuario'=>$id_usuario,
                        'img_usuario'=>$img_usuario,
                        'nick_usuario'=>$nick_usuario,
                        'detalle'=>$detalle,                            
                        'fecha'=>$fecha,
                        'id_comentario'=>$id_comentario,                                                            
                        );

                    array_push($lis_comentarios, $retorno);                                                                    
            }
            
            return $lis_comentarios;
            
        }
        
        

        
}
?>