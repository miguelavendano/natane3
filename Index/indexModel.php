<?php
    require_once ('../core/modeloSitio.php');

    class ModelIndex{        
        public $prueba;
        public $modelsitios;
        
        
        public function __construct() {

            $this->modelsitios = new ModelSitios();

        }
        
        public function get_slider(){
                
            $eslaider = array("panoramica1.jpg","panoramica4.jpg","panoramica3.jpg");
            return $eslaider;       
        }
        
        
        public function get_carrusel(){   
            
            $query = "START n=node(*) WHERE n.type='Sitio' RETURN n;";
            
            $resultado = $this->modelsitios->get_sitio_aleatorio($query, 10);

            return $resultado;
            
        }        
    }
?>
