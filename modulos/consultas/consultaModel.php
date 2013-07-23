<?php   
    require_once('../../core/modeloSitio.php');
    require_once('../../librerias/neo4jphp.phar');
    require_once('../../librerias/Neo4Play.php');    
    

    class ConsultaModel{
        
        public $modelsitios;
        public $consulta;
        
        
        public function __construct($busqueda) {
            
            $this->modelsitios = new ModelSitios();
            $this->consulta = $busqueda;
            
            
        }       
        
        
        public function get_resultados(){   
            
            
            $query = "START n=node(*) WHERE n.type='Sitio' RETURN n;";       
            $ale = rand(1, 20);
            
            $resultado = $this->modelsitios->get_sitio_aleatorio($query, $ale);
            
            return $resultado;
            
        }  
    }
        
?>
