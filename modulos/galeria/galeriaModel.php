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
    
    
    /**
     * Clase controlador de la interacción con la base de datos del modulo Galeria.
     */    
    class GaleriaModel{
        
        /**
         *Instancia de la Clase ModelSitios.
         * @var  ModelSitios
         */        
        public $modelsitios;
        
        /**
         *Instancia de la Clase ModelExperiencia.
         * @var ModelExperiencia 
         */        
        public $modelexperiencia;
        
        
        /**
         * Metodo Constructor donde se inicializan los atribudos de la clase.
         * 
         */        
        public function __construct() {            
            $this->modelsitios = new ModelSitios();
            $this->modelexperiencia = new ModelExperiencia();                      
        }       
        
        
        /**
         * Construye la consulta para retornar las imagenes asociadas a la Galeria.
         * @return Array Datos de las imagenes relacionadas a la galeria.
         */        
        public function get_img_asociadas($id_sitio){                        
            
            $query = "START n=node(".$id_sitio.") MATCH n<-[:Asociada]-e-[:Img]->i RETURN i";
            $imagenes = $this->modelexperiencia->get_imagenes_galeria($query);            
            return $imagenes;
            
        }        
        
        /**
         * Construye la consulta para retornar todas las imagenes asociadas a la Galeria.
         * @return Array Datos de las imagenes relacionadas a la galeria.
         */                
        public function get_img_todas($id){            
            
            $query = "START n=node(".$id.") MATCH n<-[:Albun]-b-[:Img]->i RETURN i;";
            
            //START n=node(*) MATCH n<-[:Albun]-b-[:Img]->i RETURN count(i);
            
            $resultado = $this->modelexperiencia->get_imagenes_galeria($query);
            
            return $resultado;
            
        }
        
        /**
         * Construye la consulta para retornar todas las imagenes asociadas a la Galeria.
         * @return Array Datos de las imagenes relacionadas a la galeria.
         */                        
        public function get_img_empresas($id){            
            
            
            $query = "START n=node(".$id.") MATCH n<-[:Etiqueta]-b-[:Img]->i RETURN i;";
            
            //START n=node(*) MATCH n<-[:Albun]-b-[:Img]->i RETURN count(i);
            
            $resultado = $this->modelexperiencia->get_imagenes_galeria($query);
            
            return $resultado;
            
        }        
        
        /**
         * Construye la consulta para validar si el id pertenece a un sitio.
         * @return int 1 si es de un sitio, 0 si no lo es.
         */                        
        public function validar_sitio($id){
            
            
            if($this->modelsitios->es_un_sitio($id))                
                return 1;
                        
            return 0;
            
        }

        /**
         * Construye la consulta para validar si el id pertenece a una Empresa
         * @return int 1 si lo és, 0 si no lo és.
         */                                
        public function validar_empresa($id){
            
            
            if($this->modelsitios->es_una_empresa($id))                
                return 1;

            return 0;
            
        }
              
        /**
         * Construye la consulta traer el nombre de la empresa o sitio al que pertenece el parametro.
         * @param String $id Id a consultar.
         * @return String Nombre del padre. 
         */
        public function traer_nombre($id){
            
            $query = "START n=node(".$id.") RETURN n.nombre;";
            
            $query = new Cypher\Query(Neo4Play::client(), $query);            
            $res = $query->getResultSet();
            
            return $res[0]->offsetGet('');  
            
        }
        
    }
        
?>
