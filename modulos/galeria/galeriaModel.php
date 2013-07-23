<?php   
    require_once('../../core/modeloSitio.php');
    require_once('../../core/modeloExperiencia.php');
    require_once('../../librerias/neo4jphp.phar');
    require_once('../../librerias/Neo4Play.php');    
    

    class GaleriaModel{
        
        public $modelsitios;
        public $modelexperiencia;
        
        
        public function __construct() {
            
            $this->modelsitios = new ModelSitios();
            $this->modelexperiencia = new ModelExperiencia();
          
            
        }       
        
        
        public function get_img_todas($id_sitio){   
            
            
            $query = "START n=node(".$id_sitio.") MATCH n<-[:Albun]-b-[:Img]->i RETURN i;";
            
            $resultado = $this->modelexperiencia->get_imagenes_galeria($query);
            
            return $resultado;
            
        }  
        
        public function validar($id){
            
            return $this->modelsitios->es_un_sitio($id);
            
        }
        
    }
        
?>
