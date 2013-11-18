<?php   
    require_once('../../core/modeloSitio.php');
    require_once('../../core/modeloExperiencia.php');
    require_once('../../librerias/neo4jphp.phar');
    require_once('../../librerias/Neo4Play.php');    
    
use Everyman\Neo4j\Node,
    Everyman\Neo4j\Index,
    Everyman\Neo4j\Query\ResultSet,
    Everyman\Neo4j\Relationship,
    Everyman\Neo4j\Cypher,
    Everyman\Neo4j\Cypher\Query,
    Everyman\Neo4j\Command;
    
    
    class ImagenModel{
        
        public $modelexperiencia;
        
        
        public function __construct() {            
            $this->modelexperiencia = new ModelExperiencia();                      
        }       
        
        
        public function get_imagen($id_imagen){
            
            $query = "START i=node(".$id_imagen.") RETURN i";
            $imagen = $this->modelexperiencia->get_imagenes_galeria($query);            
            return $imagen;            
            
        }

        
        public function get_comentarios($id_imagen){

            $query = "START i=node(".$id_imagen.") MATCH i<-[:Sobre]-c RETURN c";
            $imagen = $this->modelexperiencia->get_comentarios_imagen($query);            
            return $imagen;            
            
        }        
        
        
    }
        
?>
