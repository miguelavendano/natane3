<?php

require_once('coneccion.php');
require_once('Servicio.php');
require_once('Imagen.php');

use Everyman\Neo4j\Node,
    Everyman\Neo4j\Index,
    Everyman\Neo4j\Query\ResultSet,
    Everyman\Neo4j\Relationship,
    Everyman\Neo4j\Cypher,
    Everyman\Neo4j\Cypher\Query,
    Everyman\Neo4j\Command;

class ModelServicio{
    
        public function __construct() {
            
        }
        
        /**
         * funcion para crear el nodo tipo Servicio
         * parametros: objeto tipo Servicio
         */	
	public static function crearNodoServicio(Servicio $minodo){
		if (!$minodo->node) {
			$minodo->node = new Node(Neo4Play::client());
		}

		$minodo->node->setProperty('nombre', $minodo->nombre)                        
				->setProperty('descripcion', $minodo->descripcion)
                                ->setProperty('type', $minodo->type)
				->save();

		$minodo->id = $minodo->node->getId();                
		$minodoIndex = new Index(Neo4Play::client(), Index::TypeNode,'Servicio');
		$minodoIndex->add($minodo->node, 'nombre', $minodo->nombre);
                
	}    
        
        
        /*
         * Obtiene las propiedades de un servicio
         */        
        public function get_servicio($queryString){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();            
            
            $array = array();
            
            if($result){
                
                foreach($result as $row) {
                    $servicio = new Servicio();
                    $servicio->id = $row['']->getId();
                    $servicio->nombre = $row['']->getProperty('nombre');
                    $servicio->descripcion = $row['']->getProperty('descripcion');                    
                    array_push($array, $servicio);
                }
                return $array;
            }                        
        }

       
        /*
         * Funcion que edita una propiedad de una experiencia y si no existe la crea
         */        
	public static function editar_servicio($idnodo, $propiedad, $detalle){
		//Obtengo toda la informacion del nodo
		$editar = Neo4Play::client()->getNode($idnodo);
		//edita la propiedad y si no existe la crea
		$editar->setProperty($propiedad,$detalle)
		    	->save();
	}              

        /*
         * Elimina el nodo servicio
         */
	public static function eliminarServicio($id_servicio){
            
            $eliminar = Neo4Play::client()->getNode($id_servicio);		
            $eliminar->delete();	
            
	}                
        
        /*
         * Elimina las imagenes de una experiencia
         */
	public static function eliminar_nodos_ImgServicio($ids_nodoImgExp){
            
            foreach($ids_nodoImgExp as $value){
                    $eliminar = Neo4Play::client()->getNode($row['']->getId());
                    $eliminar->delete();			    	                                                                            
            }
            
	}        
        
}
