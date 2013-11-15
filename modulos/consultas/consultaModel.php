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

            //$query = "START n=node(*) WHERE n.nombre =~ '(?i).*".$this->consulta.".*' AND n.type<>'Imagen' AND n.type<>'Experiencia' AND n.type<>'Servicio' RETURN n";
            $query = "START n=node(*) WHERE n.nombre =~ '(?i).*".$this->consulta.".*' AND (n.type='Usuario' OR n.type='Sitio' OR n.type='Empresa') RETURN n";            
            //$ale = rand(1, 20);
            
            //$resultado = $this->modelsitios->get_sitio_aleatorio($query, $ale);
            
            $resultado = $this->modelsitios->get_todo($query);
            
            if($resultado){
                return $resultado;
            }
            else{ return; }
            
                
            
        }  
    }
        
?>
