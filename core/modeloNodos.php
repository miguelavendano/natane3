<?php

require_once('coneccion.php');
require_once('Sitio.php');
require_once('Empresa.php');
require_once('Usuario.php');
require_once('Imagen.php');

use Everyman\Neo4j\Node,
    Everyman\Neo4j\Index,
    Everyman\Neo4j\Query\ResultSet,
    Everyman\Neo4j\Relationship,
    Everyman\Neo4j\Cypher,
    Everyman\Neo4j\Cypher\Query,
    Everyman\Neo4j\Command;


class ModelNodos{
    
        public function __construct() {
            
        }
               
        
        public function get_todo($queryString){
                        
            $query = new Cypher\Query(Neo4Play::client(), $queryString);
            $result = $query->getResultSet();
                       
            if(count($result)>0){  
                
                $nodos = "";
                foreach ($result as $row){                          
                    $nodos.=",".$row['']->getId();
                }                

                $cadnodos = substr($nodos,1);

                $losconsulta = "START n=node(".$cadnodos.") RETURN n";
                $consul = new Cypher\Query(Neo4Play::client(), $losconsulta);

                $respuesta = $consul->getResultSet();       
                
                $resultado = array();
//                $arsitios = array();
//                $arusuarios = array();
//                $arempresas = array();

                foreach ($respuesta as $row){
                    
                    if($row['']->getProperty('type')=="Sitio"){
                        $sitio = new Sitio();
                        $sitio->id = $row['']->getId();
                        $sitio->nombre = $row['']->getProperty('nombre');
                        $sitio->descripcion = $row['']->getProperty('descripcion');
                        $sitio->tipo_sitio = $row['']->getProperty('tipo_sitio');
                        $sitio->imagen = $row['']->getProperty('imagen');
                        $sitio->type = $row['']->getProperty('type');
                        //array_push($arsitios, $sitio);   
                        array_push($resultado, $sitio);
                    }
                    elseif($row['']->getProperty('type')=="Empresa"){
                        $empresa = new Empresa();
                        $empresa->id = $row['']->getId();
                        $empresa->nombre = $row['']->getProperty('nombre');
                        $empresa->descripcion = $row['']->getProperty('descripcion');
                        $empresa->imagen = $row['']->getProperty('imagen');
                        $empresa->type = $row['']->getProperty('type');
                        //array_push($arempresas, $empresa);                        
                        array_push($resultado, $empresa);
                    }
                    elseif($row['']->getProperty('type')=="Usuario"){
                        $usuario = new Usuario();
                        $usuario->id = $row['']->getId();
                        $usuario->nombre = $row['']->getProperty('nombre');
                        $usuario->apellido = $row['']->getProperty('apellido');
                        $usuario->nick = $row['']->getProperty('nick');
                        $usuario->imagen = $row['']->getProperty('imagen');
                        $usuario->type = $row['']->getProperty('type');
                        //array_push($arusuarios, $usuario);                                                
                        array_push($resultado, $usuario);
                    }                                                        
                }            
                
                return $resultado;                
            }
            
            else{ return; }            
        }


//        public function get_todo($queryString){
//                        
//            $query = new Cypher\Query(Neo4Play::client(), $queryString);
//            $result = $query->getResultSet();
//                       
//            if(count($result)>0){  //pregunta si encontro resultados
//                
//                $nodos = "";
//
//                foreach ($result as $row){            
//                    //array_push($aux, $row['']->getId());                
//                    $nodos.=",".$row['']->getId();
//                }                
//
//                $cadnodos = substr($nodos,1);
//
//
//                $losconsulta = "START n=node(".$cadnodos.") RETURN n";
//                $consul = new Cypher\Query(Neo4Play::client(), $losconsulta);
//
//                $respuesta = $consul->getResultSet();       
//
//                $arsitios = array();
//
//                foreach ($respuesta as $row){                    
//                    $sitio = new Sitio();
//                    $sitio->id = $row['']->getId();
//                    $sitio->nombre = $row['']->getProperty('nombre');
//                    $sitio->descripcion = $row['']->getProperty('descripcion');
//                    $sitio->tipo_sitio = $row['']->getProperty('tipo_sitio');
//                    $sitio->imagen = $row['']->getProperty('imagen');
//                    $sitio->type = $row['']->getProperty('type');
//                    array_push($arsitios, $sitio);
//                }                
//                return $arsitios;                
//            }
//            else{ return; }
//            
//        }        
        
        
}

