<?php

require_once('coneccion.php');
require_once('Sitio.php');

use Everyman\Neo4j\Node,
    Everyman\Neo4j\Index,
    Everyman\Neo4j\Query\ResultSet,
    Everyman\Neo4j\Relationship,
    Everyman\Neo4j\Cypher,
    Everyman\Neo4j\Cypher\Query,
    Everyman\Neo4j\Command;


class ModelSitios{
    
        public function __construct() {
            
        }
        
        public function aletorio($cant){                       
            
            $vector = array();            
                                
            while (count($vector)<$cant){
                
                $n = rand( 0 ,$cant);
                                              
                if(in_array($n, $vector)){
                                        
                }else{
                    array_push($vector, $n); 
                  
                }   
            }           
            
            return $vector;
        }          


        /**
         * funcion para crear el nodo tipo Sitio
         * parametros: objeto tipo Sitio
         */	
	public function crearNodoSitio(Sitio $minodo)
	{
		if (!$minodo->node) {
			$minodo->node = new Node(Neo4Play::client());
		}

		$minodo->node->setProperty('nombre', $minodo->nombre)
				->setProperty('imagen', $minodo->imagen)
				->setProperty('tipo_sitio', $minodo->tipo_sitio)
                                ->setProperty('descripcion', $minodo->descripcion)
                                ->setProperty('ciudad', $minodo->ciudad)
                                ->setProperty('telefono', $minodo->telefono)
                                ->setProperty('direccion', $minodo->direccion)
                                ->setProperty('latitud', $minodo->latitud)
                                ->setProperty('longitud', $minodo->longitud)
                                ->setProperty('correo', $minodo->correo)
                                ->setProperty('sitio_web', $minodo->sitio_web)
                                ->setProperty('facebook', $minodo->facebook)
                                ->setProperty('twitter', $minodo->twitter)
                                ->setProperty('youtube', $minodo->youtube)                        
                                ->setProperty('type', $minodo->type)
				->save();

		$minodo->id = $minodo->node->getId();                
		$minodoIndex = new Index(Neo4Play::client(), Index::TypeNode,'Sitio');
		$minodoIndex->add($minodo->node, 'nombre', $minodo->nombre);
                
	}      
        
        public function get_sitio_aleatorio($queryString, $cant){
            
                        
            $query = new Cypher\Query(Neo4Play::client(), $queryString);
            $result = $query->getResultSet();
            $nodos = array();
            
            foreach ($result as $row){
            
                array_push($nodos, $row['']->getId());                
            }                
            
            $nodale='';
            
            $comparativo = array();

            for($i=0; count($comparativo)<$cant; $i++){
                
                $n = rand(0,count($nodos)-1);
                
                if(in_array($n, $comparativo)){
                    
                }else{
                    $nodale.=$nodos[$n];
                    array_push($comparativo, $n);
                    if(count($comparativo)<$cant){
                        $nodale.=",";
                    }                        
                }

            }

            
            
            $losconsulta = "START n=node(".$nodale.") RETURN n";
            $consul = new Cypher\Query(Neo4Play::client(), $losconsulta);
            $respuesta = $consul->getResultSet();       
            
            $arsitios = array();

            foreach ($respuesta as $row){
                $sitio = new Sitio();
                $sitio->id = $row['']->getId();
                $sitio->nombre = $row['']->getProperty('nombre');
                $sitio->descripcion = $row['']->getProperty('descripcion');
                $sitio->tipo = $row['']->getProperty('tipo');
                $sitio->imagen = $row['']->getProperty('imagen');
                array_push($arsitios, $sitio);
            }

            return $arsitios;  

        }
            
        public function get_semejantes($queryString){
            
            $consul = new Cypher\Query(Neo4Play::client(), $queryString);
            $respuesta = $consul->getResultSet();       
            
            $arsitios = array();
            
            foreach ($respuesta as $row){
                $sitio = new Sitio();
                $sitio->id = $row['']->getId();
                $sitio->nombre = $row['']->getProperty('nombre');                
                $sitio->tipo = $row['']->getProperty('tipo');
                $sitio->imagen = $row['']->getProperty('imagen');
                array_push($arsitios, $sitio);
            }
            
            return $arsitios;              
        }
        
        
        public function get_contacto($queryString){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);
            
            $result = $query->getResultSet();
            
            $array = array();
            
            if($result){
                
            
                foreach($result as $row) {
                    $sitio = new Sitio();
                    $sitio->id = $row['']->getId();
                    $sitio->nombre = $row['']->getProperty('nombre');
                    $sitio->direccion = $row['']->getProperty('direccion');
                    $sitio->telefono = $row['']->getProperty('telefono');
                    $sitio->direccion = $row['']->getProperty('direccion');
                    $sitio->correo = $row['']->getProperty('correo');
                    $sitio->facebook = $row['']->getProperty('facebook');
                    $sitio->twitter = $row['']->getProperty('twitter');
                    $sitio->youtube = $row['']->getProperty('youtube');  
                    $sitio->descripcion = $row['']->getProperty('descripcion');  
                    array_push($array, $sitio);

                    
                }
                return $array;
           }
        }
           
        public function es_un_sitio($id){
            
            $query = "START n=node(".$id.") RETURN n.type";            
            $queryRes = new Cypher\Query(Neo4Play::client(), $query);      
                    
            if($queryRes){
                $res = $queryRes->getResultSet();                                        
                $tonto= $res[0]->offsetGet('');                
                if($tonto == "Sitio"){                                        
                    return 1;
                }  else {
                    return 0;
                }
                    
            }
                //$experiencia->imagen= "no hay";}            
            
            
        }
   
        
        public function get_query($queryString, $aleatorio){
            
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);
            $result = $query->getResultSet();
            $nodos = array();
            
            foreach ($result as $row){
                
                array_push($nodos, $row['']->getId());                
            }                
            
            $nodale='';
            
            $comparativo = array();
            
            for($i=0; count($comparativo)<10; $i++){
                
                $n = rand(0,count($nodos)-1);
                
                if(in_array($n, $comparativo)){
                    
                }else{
                    $nodale.=$nodos[$n];
                    array_push($comparativo, $n);
                    if(count($comparativo)<10){
                        $nodale.=",";
                    }                        
                }

            }
            

            
            $losconsulta = "START n=node(".$nodale.") RETURN n";
            $consul = new Cypher\Query(Neo4Play::client(), $losconsulta);
            $respuesta = $consul->getResultSet();       
            
            $arsitios = array();
            
            foreach ($respuesta as $row){
                $sitio = new Sitio();
                $sitio->id = $row['']->getId();
                $sitio->nombre = $row['']->getProperty('nombre');
                $sitio->descripcion = $row['']->getProperty('descripcion');
                $sitio->tipo = $row['']->getProperty('tipo');
                $sitio->imagen = $row['']->getProperty('imagen');
                array_push($arsitios, $sitio);
            }
            
            return $arsitios;  

        }
        
        
        
      
        
}

