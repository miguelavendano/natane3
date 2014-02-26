<?php

require_once('coneccion.php');
require_once('Publicacion.php');
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


class ModelPublicacion{
    
        public function __construct() {
            
        }
        
        
        /**
         * funcion para crear el nodo tipo Experiencia
         * @param objeto $minodo Objeto de tipo publicacion que contiene los datos
         *  para un nodo tipo Noticia
         */	
	public static function crearNodoNoticia(Publicacion $minodo){
            
		if (!$minodo->node) {
			$minodo->node = new Node(Neo4Play::client());
		}

		$minodo->node->setProperty('nombre', $minodo->nombre)
				->setProperty('descripcion', $minodo->descripcion)
                                ->setProperty('imagen', $minodo->fecha)
                                ->setProperty('fecha', $minodo->fecha)                       
                                ->setProperty('type', $minodo->type)
				->save();

		$minodo->id = $minodo->node->getId();

		$minodoIndex = new Index(Neo4Play::client(), Index::TypeNode, 'Noticia');
		$minodoIndex->add($minodo->node, 'nombre', $minodo->nombre);
                
	}  

        /**
         * funcion para crear el nodo tipo Experiencia
         * @param objeto $minodo Objeto de tipo publicacion que contiene los datos
         *  para un nodo tipo Evento
         */	        
	public static function crearNodoEvento(Publicacion $minodo){
            
		if (!$minodo->node) {
			$minodo->node = new Node(Neo4Play::client());
		}

		$minodo->node->setProperty('nombre', $minodo->nombre)
				->setProperty('descripcion', $minodo->descripcion)
                                ->setProperty('imagen', $minodo->imagen)
                                ->setProperty('fecha_evento', $minodo->fecha_evento)
                                ->setProperty('hora_evento', $minodo->hora_evento)                        
                                ->setProperty('fecha', $minodo->fecha)                       
                                ->setProperty('type', $minodo->type)
				->save();

		$minodo->id = $minodo->node->getId();

		$minodoIndex = new Index(Neo4Play::client(), Index::TypeNode, 'Evento');
		$minodoIndex->add($minodo->node, 'nombre', $minodo->nombre);
                
	}  
        
        /**
         * Funcion que edita una propiedad de una publicacion y si no existe la crea
         * 
         * @param integer $idnodo ID del nodo administrador a editar
         * @param string $propiedad Propiedad del nodo administrador a editar
         * @param string $detalle Detalle a ingresar en la propiedad
         */
	public static function editar_publicacion($idnodo, $propiedad, $detalle){
		//Obtengo toda la informacion del nodo
		$editar = Neo4Play::client()->getNode($idnodo);
		//edita la propiedad y si no existe la crea
		$editar->setProperty($propiedad,$detalle)
		    	->save();
	}              

        /**
         * Funcion que elimina una publicacion
         * @param integer $idnodo ID de la publicacion a eliminar
         */
	public static function eliminar_publicacion($idnodo){
            $eliminar = Neo4Play::client()->getNode($idnodo);		
            $eliminar->delete();			    	
	}

       
        /**
         * Funcion que obtiene las noticias publicadas por el administrados
         * @param string $queryString cadena de texto que contiene la consulta de las noticias
         */
        public static function get_noticias($queryString){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();            
            $array = array();
            
            if($result){
                foreach($result as $row) {
                    
                    $publicacion = new Publicacion();  
                    $publicacion->id = $row['']->getId();
                    $publicacion->nombre = $row['']->getProperty('nombre');
                    $publicacion->descripcion = $row['']->getProperty('descripcion');
                    $publicacion->imagen = $row['']->getProperty('imagen');
                    //$servicio->type = $row['']->getProperty('type');                    
                    
//                    $query="START n=node(".$servicio->id.") MATCH n-[:Img]->i RETURN i.nombre";                     
//                    $queryRes = new Cypher\Query(Neo4Play::client(), $query);      
//                    $res = $queryRes->getResultSet();
//                    
//                    if(count($res)){
//                        foreach($res as $img) {    
//                           $servicio->imagen = $img[''];
//                        }
//                    }else{
//                        $servicio->imagen = "rafting-rio-savegre.jpg";
//                    }                    
                    
                    array_push($array, $publicacion);
                }
                return $array;
            }           
        }
        

        /**
         * Funcion que obtiene los eventos publicadas por el administrados
         * @param string $queryString cadena de texto que contiene la consulta de los eventos
         */
        public static function get_eventos($queryString){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();            
            $array = array();
            
            if($result){
                foreach($result as $row) {
                    
                    $publicacion = new Publicacion();  
                    $publicacion->id = $row['']->getId();
                    $publicacion->nombre = $row['']->getProperty('nombre');
                    $publicacion->descripcion = $row['']->getProperty('descripcion');
                    $publicacion->imagen = $row['']->getProperty('imagen');
                    $publicacion->fecha_evento = $row['']->getProperty('fecha_evento');
                    $publicacion->hora_evento = $row['']->getProperty('hora_evento');
                    
//                    $query="START n=node(".$servicio->id.") MATCH n-[:Img]->i RETURN i.nombre";                     
//                    $queryRes = new Cypher\Query(Neo4Play::client(), $query);      
//                    $res = $queryRes->getResultSet();
//                    
//                    if(count($res)){
//                        foreach($res as $img) {    
//                           $servicio->imagen = $img[''];
//                        }
//                    }else{
//                        $servicio->imagen = "rafting-rio-savegre.jpg";
//                    }                    
                    
                    array_push($array, $publicacion);
                }
                return $array;
            }           
        }        
             
        
        
        /*
         * Obtine todas las imagenes de una experiencia
         */                
        public static function get_imagenes_publicacio($id_experiencia){                    
            
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


        
}
?>