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
    
    
    class GaleriaModel{
        
        public $modelsitios;
        public $modelexperiencia;
        
        
        public function __construct() {
            
            $this->modelsitios = new ModelSitios();
            $this->modelexperiencia = new ModelExperiencia();
          
            
        }       
        
        
        public function get_img_todas($id){            
            
            $query = "START n=node(".$id.") MATCH n<-[:Albun]-b-[:Img]->i RETURN i;";
            
            //START n=node(*) MATCH n<-[:Albun]-b-[:Img]->i RETURN count(i);
            
            $resultado = $this->modelexperiencia->get_imagenes_galeria($query);
            
            return $resultado;
            
        }
        
        
        public function get_img_empresas($id){            
            
            
            $query = "START n=node(".$id.") MATCH n<-[:Etiqueta]-b-[:Img]->i RETURN i;";
            
            //START n=node(*) MATCH n<-[:Albun]-b-[:Img]->i RETURN count(i);
            
            $resultado = $this->modelexperiencia->get_imagenes_galeria($query);
            
            return $resultado;
            
        }        
        
        
        public function validar_sitio($id){
            
            
            if($this->modelsitios->es_un_sitio($id))                
                return 1;
                        
            return 0;
            
        }
        
        public function validar_empresa($id){
            
            
            if($this->modelsitios->es_una_empresa($id))                
                return 1;

            return 0;
            
        }
              
        
        public function traer_nombre($id){
            
            $query = "START n=node(".$id.") RETURN n.nombre;";
            
            $query = new Cypher\Query(Neo4Play::client(), $query);            
            $res = $query->getResultSet();
            
            return $res[0]->offsetGet('');  
            
        }
        
    }
        
?>
