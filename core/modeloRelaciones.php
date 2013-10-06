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
/*

	public static function consulta($idNodoStart)
	{

		if ($idNodoStart){			
			
			$nodoStart = Neo4Play::client()->getNode($idNodoStart);
		
			$queryString = "START d = node:sitios(name='".$nodoStart->getProperty('name')."') MATCH d-[:Socios]->friend-[:Socios]->friend_of_friend RETURN friend_of_friend";			

			$query = new Cypher\Query(Neo4Play::client(), $queryString);						  
			$result = $query->getResultSet();	

			if($result){							
				echo "Se encontraron ".count($result)." amigos.\n";
				foreach($result as $row) {
					echo "  ".$row['']->getProperty('name')."\n";
				}
			}
		}
	}
*/


}

