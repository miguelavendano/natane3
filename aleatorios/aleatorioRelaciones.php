<?php

require_once('../core/coneccion.php');
require_once '../core/modeloRelaciones.php';

use Everyman\Neo4j\Node,
    Everyman\Neo4j\Index,
    Everyman\Neo4j\Relationship,
    Everyman\Neo4j\Cypher,
    Everyman\Neo4j\Cypher\Query,
    Everyman\Neo4j\Query\ResultSet,
    Everyman\Neo4j\Command;

echo "busca 2";
    class Aleatorio{
        
        public $usuario;
        public $empresa;
        public $sitio;
        public $experiencia;
        public $img;
        public $departamento;
        
        
        
        
        public function __construct() {
            
            $this->usuario = array();
            $this->empresa = array();
            $this->sitio = array();
            $this->experienia = array();
            $this->img = array();    
            $this->departamento = array();
            
            
        }
        
        public function consulta($tipo){
            echo "busca 60";
            
            $queryString = "START n=node(*) WHERE n.type='".$tipo."' RETURN n";
            
            // para qeu funciones esta consulta hay que crearle la propiedad type al nodo cero (Y)

            $query = new Cypher\Query(Neo4Play::client(), $queryString);						  
            $result = $query->getResultSet();	
            
            echo "busca 61";
            
            $vector = array();

            if($result){							
                
                    foreach($result as $row) {
                        array_push($vector, $row['']->getId());

                   }
            }            
            
            return $vector;
            
        }
        
        public function inicializar(){
            echo "busca 50";
            $this->empresa = $this->consulta("Empresa");
            echo "busca 51";
            $this->experiencia = $this->consulta("Experiencia");
            $this->img = $this->consulta("Imagen");
            $this->sitio = $this->consulta("Sitio");
            $this->usuario = $this->consulta("Usuario");
            $this->departamento = $this->consulta("Departamento");
            
        }
        
        
        public function relacionesUsuario($array1 , $array2, $relacion, $cant){
            
            
            $sitioempres = array();
            
            
            
            echo count($array1)." -- ".count($array2)."<br>";
            
            for($i=0; $i<$cant; $i++){
                $us = rand(0,count($array1)-1);
                $em = rand(0,count($array2)-1);                             
                
                $convi = $us.$em;
                if(in_array($convi, $sitioempres)){
                                        
                }else{
                    array_push($sitioempres, $convi);
                    echo $i." ---> ".$convi."<br>";
                    ModeloRelaciones::crearRelacion($array1[$us], $array2[$em], $relacion);
                }   
            }
            
        }
        
        
        
        
        
    }

echo "busca 3";
    $obj = new Aleatorio();
    $obj->inicializar();
    echo "busca 4";
echo "Relaciones de usuarios";
    
//    $obj->relacionesUsuario($obj->usuario, $obj->empresa,"Cliente", 10);
        //$obj->relacionesUsuario($obj->usuario, $obj->sitio,"Fan", 35);
//    $obj->relacionesUsuario($obj->usuario, $obj->sitio,"Desea", 35);
    //$obj->relacionesUsuario($obj->usuario, $obj->usuario,"Amigo", 40);
    //$obj->relacionesUsuario($obj->usuario, $obj->experiencia,"Comparte", 29);
//    $obj->relacionesUsuario($obj->usuario, $obj->departamento,"Ubicado", 1);
//                        
//echo "Relaciones de empresas";
//    
//    $obj->relacionesUsuario($obj->empresa, $obj->empresa,"Partner", 10);
//    $obj->relacionesUsuario($obj->empresa, $obj->sitio,"Servicio", 5);   
    $obj->relacionesUsuario($obj->empresa, $obj->usuario,"Amigo", 20);
//    $obj->relacionesUsuario($obj->empresa, $obj->experiencia,"Comparte", 30);
//    $obj->relacionesUsuario($obj->empresa, $obj->departamento,"Ubicado", 1);
//
//echo "Relaciones de experiencias";
//    
//    $obj->relacionesUsuario($obj->experiencia, $obj->empresa,"Etiqueta", 5);
//    $obj->relacionesUsuario($obj->experiencia, $obj->sitio,"Albun", 30);   
//    $obj->relacionesUsuario($obj->experiencia, $obj->usuario,"Etiqueta", 5);
//    $obj->relacionesUsuario($obj->experiencia, $obj->img,"Img", 70);    
//    
//    
//echo "Relaciones de Sitios";
//    
//    $obj->relacionesUsuario($obj->sitio, $obj->sitio,"Semejantes", 15);
//    $obj->relacionesUsuario($obj->sitio, $obj->departamento,"Ubicado", 1);
//  
    echo "<h1> Listo pues parceros !!!! </h1>";
    
?>

