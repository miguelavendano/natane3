<?php
    
    require_once('../../core/modeloEmpresa.php');    
    require_once('../../librerias/neo4jphp.phar');
    require_once('../../librerias/Neo4Play.php');    
    require_once('../../core/modeloSitio.php');  
    require_once('../../core/modeloExperiencia.php');  
    
    

    class EmpresaModel{
        
        public $modelempresas;
        public $modelemsitios;
        public $modelexpe;
        public $id_empresa;
        
        
        public function __construct($id) {
            $this->modelempresas = new ModelEmpresa();
            $this->modelemsitios = new ModelSitios();
            $this->modelexpe = new ModelExperiencia();
            $this->id_empresa= $id;
        }       
        
        public function get_contacto(){
            $query = "START n=node(".$this->id_empresa.") RETURN n";            
            $resultado = $this->modelempresas->get_contacto($query);
            return $resultado;
        }
        
        
        public function  get_slider(){
            //$eslaider = array("panoramica1.jpg","panoramica4.jpg","panoramica3.jpg");
            $eslaider = array("165_18959_1_finca.jpg","165_19582_1_convivencia.jpg","165_16731_1_campamento.jpg");            
            return $eslaider;      
        }        

        
        public function get_ferrocarril(){
            $query = "START n=node(*) WHERE n.type='Sitio' RETURN n;";
            $resultado = $this->modelemsitios->get_sitio_aleatorio($query, 10);
            return $resultado;     
        }        
        
        
        public function get_amigos(){   
            //$query = "START n=node(".$this->id_empresa.") MATCH n-[:Amigo]->b RETURN b";
            $query = "START n=node(".$this->id_empresa.") MATCH n<-[:Cliente]-b RETURN b";
            $resultado = $this->modelempresas->get_amigos($query);
            return $resultado;
        }          
        
        public function get_clientes_aliados(){   
            //$query = "start n=node(".$this->id_empresa.") match n<-[:Partner|Cliente]->b return b";            
            $query = "start n=node(".$this->id_empresa.") match n<-[:Partner]->b return b";            
            $resultado = $this->modelempresas->get_clientes_aliados($query);
            return $resultado;            
        }                    
        
        public function get_servicios(){   
            $query = "start n=node(".$this->id_empresa.") match n-[:Ofrece]->b return b";
            $resultado = $this->modelempresas->get_servicios($query);            
            return $resultado;            
        }   
        
        public function get_experiencias(){             
            $query = "START n=node(".$this->id_empresa.") match n<-[:Comparte|Etiqueta]->b return b;";            
            $resultado = $this->modelexpe->get_experiencias($query);
            return $resultado;            
        }                  
        

        public function get_coordenadas_mapa(){            
            $query = "START n=node(".$this->id_empresa.") RETURN n";
            //$resultado = $this->modelsitios->get_property_mapa($query);
            $resultado = $this->modelempresas->get_empresa($query);
            return $resultado;                        
        } 
        
                  
    }