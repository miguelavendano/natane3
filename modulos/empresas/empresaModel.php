<?php
    
    require_once('../../core/modeloEmpresa.php');    
    require_once('../../librerias/neo4jphp.phar');
    require_once('../../librerias/Neo4Play.php');    
    

    class EmpresaModel{
        
        public $modelempresas;
        
        
        public function __construct() {
            
            $this->modelempresas = new ModelEmpresas();
            
        }       
        
        public function get_contacto(){
            
            $query = "START n=node(2) RETURN n";            
            $resultado = $this->modelempresas->get_prueba($query);

            return $resultado;
                        
        }
        
        public function  get_slider(){

            $eslaider = array("panoramica1.jpg","panoramica4.jpg","panoramica3.jpg");
            return $eslaider;                   
            
        }        

        public function get_ferrocarril(){

            $query = "START n=node(1,2,3,4,5) RETURN n";
            
            $resultado = $this->modelempresas->get_prueba($query);

            return $resultado;            

            
        }        
        
        
        public function get_seguidores(){   
            
            
            $query = "START n=node(1,2,3,4,5,10,11) RETURN n";
            $resultado = $this->modelempresas->get_prueba($query);

            return $resultado;
            
        }          
        
        public function get_gustaria(){   
            
            
            $query = "START n=node(5, 3, 2, 4, 10, 1) RETURN n";            
            $resultado = $this->modelempresas->get_prueba($query);

            return $resultado;
            
        }                    
        
        public function get_servicios(){   
            
            
            $query = "START n=node(1,2,3,4,5,1) RETURN n";            
            $resultado = $this->modelempresas->get_prueba($query);
            
            return $resultado;
            
        }   
        
        public function get_experiencias(){   
            
            
            $query = "START n=node(1, 2, 3, 11) RETURN n";            
            $resultado = $this->modelempresas->get_prueba($query);

            return $resultado;
            
        }                  
        
        
        
                  
        

    }