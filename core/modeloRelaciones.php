<?php

require_once('coneccion.php');

use Everyman\Neo4j\Node,
    Everyman\Neo4j\Relationship,        
    Everyman\Neo4j\Query\ResultSet,
    Everyman\Neo4j\Cypher,
    Everyman\Neo4j\Cypher\Query;

/**
 * Clase con las funciones para ejecutar sobre cualquier tipo de relacion
 * (crear, eliminar, contar, consultar ...) 
 */	
class ModeloRelaciones
{

	public static function crearRelacion($idNodoStart,$idNodoEnd,$nameRelacion){

		$nodoStart = Neo4Play::client()->getNode($idNodoStart);
		$nodoEnd = Neo4Play::client()->getNode($idNodoEnd);

		$relacion = Neo4Play::client()->makeRelationship();
		$relacion->setStartNode($nodoStart)
                            ->setEndNode($nodoEnd)
                            ->setType($nameRelacion)
                            ->setProperty('inicio', $nodoStart->getProperty('name'))
                            ->setProperty('fin', $nodoEnd->getProperty('name'))
                            ->save();			
	}

	public static function eliminarRelacion($idRelacion){
	
		$eliminar = Neo4Play::client()->getRelationship($idRelacion);
		$eliminar->delete();
	}


	public static function consultarTodaRelacion($idNodo){
	
		$miNodo = Neo4Play::client()->getNode($idNodo);

		$relaciones = $miNodo->getRelationships();

		if($relaciones)
			echo "Se encontraron <b>".count($relaciones)."</b> relaciones";
		else echo "El nodo <b>NO</b> tiene relaciones";

		/*
		foreach ($relaciones->getProperties() as $key => $value) {
		    echo "<b>$key</b>: $value<br />";
		}**/	

	}	

	public static function consultarRelacionSaliente($idNodo){
	
		$miNodo = Neo4Play::client()->getNode($idNodo);
		$relaciones= $miNodo->getRelationships(array(), Relationship::DirectionOut);

		if($relaciones)
			echo "Se encontraron <b>".count($relaciones)."</b> relaciones";
		else echo "El nodo <b>NO</b> tiene relaciones";


	}	

	public static function consultarRelacionEntrante($idNodo){
	
		$miNodo = Neo4Play::client()->getNode($idNodo);
		$relaciones= $miNodo->getRelationships(array(), Relationship::DirectionIn);

		if($relaciones)
			echo "Se encontraron <b>".count($relaciones)."</b> relaciones";
		else echo "El nodo <b>NO</b> tiene relaciones";

	}			

	public static function consultarTodaRelacionSegunTipo($idNodo,$tipoRelacion){
	
		$miNodo = Neo4Play::client()->getNode($idNodo);
		$relaciones= $miNodo->getRelationships(array($tipoRelacion));

		if($relaciones)
			echo "Se encontraron <b>".count($relaciones)."</b> relaciones con ".$tipoRelacion;
		else echo "El nodo <b>NO</b> tiene relaciones con ".$tipoRelacion;
	}

	public static function consultarRelacionSalienteSegunTipo($idNodo,$tipoRelacion){
	
		$miNodo = Neo4Play::client()->getNode($idNodo);
		$relaciones= $miNodo->getRelationships(array($tipoRelacion), Relationship::DirectionOut);

		if($relaciones)
			echo "Se encontraron <b>".count($relaciones)."</b> relaciones con ".$tipoRelacion;
		else echo "El nodo <b>NO</b> tiene relaciones con ".$tipoRelacion;
	}			

	public static function consultarRelacionEntranteSegunTipo($idNodo,$tipoRelacion){

		$miNodo = Neo4Play::client()->getNode($idNodo);
		$relaciones= $miNodo->getRelationships(array($tipoRelacion), Relationship::DirectionIn);

		if($relaciones)
			echo "Se encontraron <b>".count($relaciones)."</b> relaciones con ".$tipoRelacion;
		else echo "El nodo <b>NO</b> tiene relaciones con ".$tipoRelacion;

	}					

	public static function consultarIDRelacion($idStart,$idEnd,$tipoRelacion){

                $queryString = "START i=node(".$idStart."), f=node(".$idEnd.") MATCH i-[r:".$tipoRelacion."]->f RETURN r";                

                $query = new Cypher\Query(Neo4Play::client(), $queryString);            
                $resultado = $query->getResultSet();


                //echo "Se encontraron ".count($resultado)." amigos.\n";
                foreach($resultado as $row) {
                        //echo " ".$row['']->getId()."\n";                        
                   return $row['']->getId();                        
                }                
	}	

	public static function consultaNodosEtiquetadosEnRelacion($idExperiencia){
                                       
                $queryString = "START n=node(".$idExperiencia.") MATCH n-[:Etiqueta]->i RETURN i";

                $query = new Cypher\Query(Neo4Play::client(), $queryString);            
                $resultado = $query->getResultSet();
                
                $etiquetados = array();
                //echo "Se encontraron ".count($resultado)." etiquetados.\n";
                foreach($resultado as $row){
                    array_push($etiquetados,$row['']->getId());
                }        
                
                return $etiquetados;
	}	

        
        /*
         * Obtine los ID de las relacines de un nodo dado segun su tipo
         */        
	public static function get_id_relaciones($idNodo,$tipoRelacion){
	
		$miNodo = Neo4Play::client()->getNode($idNodo);
		$relaciones= $miNodo->getRelationships(array($tipoRelacion));
                
                $id_relaciones = array();
                
                if($relaciones){
                    //echo "Se encontraron <b>".count($relaciones)."</b> relaciones";
                    foreach ($relaciones as $valor){
                        //echo "<h1>".$valor->getId()."</h1>";
                        array_push($id_relaciones, $valor->getId());
                    }
                    return $id_relaciones;
                }			
		else return null;//echo "El nodo <b>NO</b> tiene relaciones";
	}	

        
        /*
         *Obtengo el id de las imagenes de una relacion
         */
	public static function get_ids_imagenes_relacion($TipoRelacion){
            
            $queryString = "START n=node(".$TipoRelacion.") MATCH n-[:Img]->i RETURN i;";            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();            
            
            $imagenes = array();
            if($result){                
            
                foreach($result as $row) {   
                    //echo $row['']->getId()."<br>";
                    array_push($imagenes,$row['']->getId());
                }
                return $imagenes;
            }   
	}               

        
        /*
         * Elimina Varias Relaciones
         */
	public static function eliminar_relaciones($ids_relaciones){
            
            foreach($ids_relaciones as $value) {
		$eliminar = Neo4Play::client()->getRelationship($value);
		$eliminar->delete();                            
            }            
        }                
                     
        
        /*
         * Elimina Varios NOdos
         */
	public static function eliminar_nodos($ids_nodos){
            
            foreach($ids_nodos as $value){
                    $eliminar = Neo4Play::client()->getNode($row['']->getId());
                    $eliminar->delete();			    	                                                                            
            }
            
	}        

}

