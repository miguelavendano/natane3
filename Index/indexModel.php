<?php
    require_once ('../core/modeloSitio.php');
    require_once ('../core/modeloPublicacion.php');
    require_once ('../core/modeloUsuario.php');

    class ModelIndex{       
        
        public $prueba;
        public $modelsitios;
        public $modelpublicacion;
        public $modelusuarios;
        
        public function __construct() {

            $this->modelsitios = new ModelSitios();
            $this->modelpublicacion = new ModelPublicacion();
            $this->modelusuarios = new ModelUsuarios();

        }
        
        public function get_slider(){
                
            $eslaider = array("panoramica1.jpg","panoramica4.jpg","panoramica3.jpg");
            return $eslaider;       
        }
        
        
        public function get_carrusel(){   
            
            $query = "START n=node(*) WHERE n.type='Sitio' RETURN n limit 50;";            
            $resultado = $this->modelsitios->get_sitio_aleatorio($query, 10);

            return $resultado;
            
        }        
        
        
        public function toda_noticias(){   
                        
            $query = "START n=node(*) WHERE n.type?='Noticia' RETURN n";            
            $resultado = $this->modelpublicacion->get_noticias($query);

            return $resultado;            
        } 
        
        
        public function todo_eventos(){   
                        
            $query = "START n=node(*) WHERE n.type?='Evento' RETURN n";            
            $resultado = $this->modelpublicacion->get_eventos($query);

            return $resultado;            
        }         
        
        public function algunos_usuarios(){   
                        
            $query = "START n=node(*) WHERE n.type='Usuario' RETURN n limit 20";            
            $resultado = $this->modelusuarios->get_usuarios_aleatorios($query,9);

            return $resultado;            
        }        
        
    }
?>