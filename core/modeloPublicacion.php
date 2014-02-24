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
         * parametros: objeto tipo Experiencia
         */	
	public static function crearNodoPublicacion(Publicacion $minodo)
	{
		if (!$minodo->node) {
			$minodo->node = new Node(Neo4Play::client());
		}

		$minodo->node->setProperty('nombre', $minodo->nombre)
				->setProperty('descripcion', $minodo->descripcion)
                                ->setProperty('fecha', $minodo->fecha)
                                ->setProperty('type', $minodo->type)
				->save();

		$minodo->id = $minodo->node->getId();

		$minodoIndex = new Index(Neo4Play::client(), Index::TypeNode, $minodo->type);
		$minodoIndex->add($minodo->node, 'nombre', $minodo->nombre);
                
	}  

        /*
         * Funcion que edita una propiedad de una experiencia y si no existe la crea
         */        
	public static function editar_publicacion($idnodo, $propiedad, $detalle){
		//Obtengo toda la informacion del nodo
		$editar = Neo4Play::client()->getNode($idnodo);
		//edita la propiedad y si no existe la crea
		$editar->setProperty($propiedad,$detalle)
		    	->save();
	}              

        /*
         * Elimina el nodo de una experiencia
         */
	public static function eliminar_publicacion($idnodo){
            $eliminar = Neo4Play::client()->getNode($idnodo);		
            $eliminar->delete();			    	
	}

       
        /*
         * Obtine las publicaciones de un usuario
         */                
        public static function get_publicacion_usuario($queryString){
                        
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();
            
            $array = array();
//                    $experiencia->imagen= $res[0]->offsetGet('');//                    
//                    echo "<h1>".$experiencia->imagen."</h1>";                    
            
            if($result){
            
                $imagenes="";
                foreach($result as $row) {
                    $experiencia = new Experiencia();
                    $experiencia->id = $row['']->getId();
                    
                    $query = "START n=node(".$experiencia->id.") MATCH n-[:Img]->i RETURN i.nombre;";                    
                    $queryRes = new Cypher\Query(Neo4Play::client(), $query);      
                    
                    if($queryRes){
                        
                        $res = $queryRes->getResultSet();
                        
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
                    
                    
                    $experiencia->nombre = $row['']->getProperty('nombre');
                    $experiencia->descripcion = $row['']->getProperty('descripcion');
                    array_push($array, $experiencia);
                    $res=null;
                }
                return $array;
            }
        }        

       
        /*
         * Obtine las experiencias de una empresa o sitio
         */                
        public static function get_publicaciones($queryString){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();            
            $array = array();
            
            if($result){

                foreach($result as $row) {
                    $experiencia = new Experiencia();
                    $experiencia->id = $row['']->getId();
                    
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
                    
                    $experiencia->nombre = $row['']->getProperty('nombre');
                    $experiencia->descripcion = $row['']->getProperty('descripcion');
                    array_push($array, $experiencia);
                    $res=null;
                    
                    
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