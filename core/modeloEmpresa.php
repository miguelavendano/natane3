<?php

require_once('coneccion.php');
require_once('Empresa.php');


use Everyman\Neo4j\Node,
    Everyman\Neo4j\Index,
    Everyman\Neo4j\Query\ResultSet,
    Everyman\Neo4j\Relationship,
    Everyman\Neo4j\Cypher,
    Everyman\Neo4j\Cypher\Query,
    Everyman\Neo4j\Command;


class ModelEmpresa{
    
        public function __construct() {
            
        }
        
        
        /**
         * funcion para crear el nodo tipo Empresa
         * parametros: objeto tipo Empresa
         */	
	public static function crearNodoEmpresa(Empresa $minodo)
	{
		if (!$minodo->node) {
			$minodo->node = new Node(Neo4Play::client());
		}

		$minodo->node->setProperty('nombre', $minodo->nombre)
				->setProperty('imagen', $minodo->imagen)
				->setProperty('nit', $minodo->nit)
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
                                ->setProperty('contraseña', $minodo->contraseña)
                                ->setProperty('type', $minodo->type)
				->save();        
                      
		$minodo->id = $minodo->node->getId();
                echo $minodo->id;
		$minodoIndex = new Index(Neo4Play::client(), Index::TypeNode,'Empresa');
		$minodoIndex->add($minodo->node, 'nombre', $minodo->nombre);
	}      

        
        public function get_contacto($queryString){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);
            
            $result = $query->getResultSet();
            
            $array = array();
            
            if($result){
                
            
                foreach($result as $row) {
                    $empresa = new Empresa();
                    $empresa->id = $row['']->getId();
                    $empresa->nombre = $row['']->getProperty('nombre');
                    $empresa->direccion = $row['']->getProperty('direccion');
                    $empresa->telefono = $row['']->getProperty('telefono');
                    $empresa->direccion = $row['']->getProperty('direccion');
                    $empresa->correo = $row['']->getProperty('correo');
                    $empresa->sitio_web = $row['']->getProperty('sitio_web');                    
                    $empresa->descripcion = $row['']->getProperty('descripcion');  
                    
                    $empresa->facebook = $row['']->getProperty('facebook');
                    $empresa->twitter = $row['']->getProperty('twitter');
                    $empresa->youtube = $row['']->getProperty('youtube');  
                    
                    array_push($array, $empresa);

                    
                }
                return $array;
           }
        }        
        
        
        
        public function get_empresa_aleatorio($queryString, $cant){
            
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);
            $result = $query->getResultSet();
            $nodos = array();
            
            foreach ($result as $row){
                //echo $row['']->getId()."<br>";
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
            
            //echo "nodale= ".$nodale;
            
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
