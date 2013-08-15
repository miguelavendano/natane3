<?php

require_once('coneccion.php');
require_once('Experiencia.php');
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
                echo $minodo->id;
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
         * Funcion para Eliminara el nodo de una experiencia
         */
	public static function eliminar_experiencia($idnodo)
	{
		//Obtengo toda la informacion del nodo
		$eliminar = Neo4Play::client()->getNode($idnodo);
		//elimina el nodo
		$eliminar->delete();			    	
	}
        
        public function get_exper_usuario($queryString){
            
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);
            
            $result = $query->getResultSet();
            
            $array = array();
//                    $experiencia->imagen= $res[0]->offsetGet('');
//                    
//                    echo "<h1>".$experiencia->imagen."</h1>";                    
            
            if($result){
                
            
                foreach($result as $row) {
                    $experiencia = new Experiencia();
                    $experiencia->id = $row['']->getId();
                    
                    
                    $query = "START n=node(".$experiencia->id.") MATCH n-[:Img]->i RETURN i.nombre;";                    
                    
                    $queryRes = new Cypher\Query(Neo4Play::client(), $query);      
                    
                    if($queryRes){
                        $res = $queryRes->getResultSet();                                        
                        $experiencia->imagen= $res[0]->offsetGet('');
                        //echo "<h1> Id=".$experiencia->id."-->".$experiencia->imagen."</h1>";
                    }else{
                        $experiencia->imagen= "no hay";}
                    
                    $experiencia->nombre = $row['']->getProperty('nombre');
                    $experiencia->descripcion = $row['']->getProperty('descripcion');
                    array_push($array, $experiencia);
                    $res=null;
                    
                    
                }
                return $array;
            }

        }        

        
        
        public function get_experiencias($queryString){
            
            
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
                        $experiencia->imagen= $res[0]->offsetGet('');
                        //echo "<h1> Id=".$experiencia->id."-->".$experiencia->imagen."</h1>";
                    }else{
                        $experiencia->imagen= "no hay";                        
                        }
                    
                    $experiencia->nombre = $row['']->getProperty('nombre');
                    $experiencia->descripcion = $row['']->getProperty('descripcion');
                    array_push($array, $experiencia);
                    $res=null;
                    
                    
                }
                return $array;
            }

        }        
        
        
        public function get_imagenes_galeria($queryString){
                       
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $imagen = $query->getResultSet();                                  
            
            $img_galeria = array();

            foreach($imagen as $img) {                    
                
                $query = "START n=node(".$img['']->getId().") MATCH n<-[:Img]-e<-[:Comparte]-u RETURN u";
                $queryRes = new Cypher\Query(Neo4Play::client(), $query);                          
                $usuario = $queryRes->getResultSet();                    
                
                $retorno = array(
                    'img_nombre'=>$img['']->getProperty('nombre'), 
                    'img_id'=>$img['']->getId(), 
                    'usuario_id'=>$usuario[0]['']->getId(),
                    'usuario_img'=>$usuario[0]['']->getProperty('imagen'), 
                    'usuario_nick'=>$usuario[0]['']->getProperty('nick')
                    );


                array_push($img_galeria, $retorno);
            }    
            return $img_galeria;                      
        }
        
        /*
         * Consulta todas las relaciones segun un tipo especifico
         * recibe el nodo de la experiencia y el tiipo de relacion
         */
	public static function relacionesExperiencia($idNodo,$tipoRelacion)
	{
		$miNodo = Neo4Play::client()->getNode($idNodo);
		$relaciones= $miNodo->getRelationships(array($tipoRelacion));

                echo $relaciones;
	}        
        
        
}
?>