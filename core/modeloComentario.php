<?php

require_once('coneccion.php');
require_once('Comentario.php');

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
	public static function crearNodoComentario(Comentario $minodo){
		if (!$minodo->node) {
			$minodo->node = new Node(Neo4Play::client());
		}

		$minodo->node->setProperty('usuario', $minodo->usuario)                        
				->setProperty('detalle', $minodo->detalle)
                                ->setProperty('type', $minodo->type)
				->save();

		$minodo->id = $minodo->node->getId();                
		$minodoIndex = new Index(Neo4Play::client(), Index::TypeNode,'Comentario');
		$minodoIndex->add($minodo->node, 'detalle', $minodo->nombre);
                
	}    
        
        
        /*
         * Obtiene las propiedades de un servicio
         */        
        public function get_comentario($queryString){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();            
            
            $array = array();
            
            if($result){
                
                foreach($result as $row) {
                    $servicio = new Servicio();
                    $servicio->id = $row['']->getId();
                    $servicio->usuario = $row['']->getProperty('usuario');
                    $servicio->detalle = $row['']->getProperty('detalle');                    
                    array_push($array, $servicio);
                }
                return $array;
            }                        
        }

       
        /*
         * Funcion que edita una propiedad de una experiencia y si no existe la crea
         */        
	public static function editar_comentario($idnodo, $propiedad, $detalle){
		//Obtengo toda la informacion del nodo
		$editar = Neo4Play::client()->getNode($idnodo);
		//edita la propiedad y si no existe la crea
		$editar->setProperty($propiedad,$detalle)
		    	->save();
	}              

        /*
         * Elimina el nodo del comentario
         */
	public static function eliminarComentario($id_comentario){
            
            $eliminar = Neo4Play::client()->getNode($id_comentario);		
            $eliminar->delete();	
            
	}                
             
        
}