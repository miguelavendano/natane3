<?php

require_once('coneccion.php');

use Everyman\Neo4j\Node,
    Everyman\Neo4j\Index,
    Everyman\Neo4j\Query\ResultSet,
    Everyman\Neo4j\Relationship,
    Everyman\Neo4j\Cypher,
    Everyman\Neo4j\Cypher\Query,
    Everyman\Neo4j\Command;


class Validar{
    
    
    public function __construct() {
        ;
    }
    
    
    public function aux_validar($id){

        $query = "START n=node(".$id.") RETURN n.type";            
        $queryRes = new Cypher\Query(Neo4Play::client(), $query);      

        $res = $queryRes->getResultSet();                                        
        $tonto= $res[0]->offsetGet('n.type');                     
        

        
        return $tonto;
        
    }
    
    
    
    public function validar_id( $id, $caso){  // validar si el id que le pasan si corresponde a una sitio, empresa o usuario
        
        $array_ids = array('Empresa', 'Sitio', 'Experiencia', 'Imagen', 'Usuario');
        
        $opcion = $this->aux_validar($id);
        
        if(in_array($opcion, $array_ids)){                        
            
            if($opcion == $caso){
                
                
                return 1;                
                
            }else{
                
                
                return 0;
            }

        }else{
            
            
            return 0;
        }
        
        
    }
    
}



?>
