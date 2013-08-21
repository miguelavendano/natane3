<?php
    
    require_once('../../core/modeloSitio.php');   
    require_once('../../core/modeloUsuario.php');   
    require_once('../../librerias/neo4jphp.phar');
    require_once('../../librerias/Neo4Play.php');    
    

    class SitioModel{
        
        public $modelsitios;
        public $id_sitio;
        public $modelusuario;
        
        
        public function __construct($id) {
            
            $this->modelsitios = new ModelSitios();
            $this->modelusuario = new ModelUsuarios();
            $this->id_sitio = $id;
            
        }       
        
        public function get_contacto(){
            
            $query = "START n=node(".$this->id_sitio.") RETURN n";            
            $resultado = $this->modelsitios->get_contacto($query);

            return $resultado;                        
        }
        
        public function  get_slider(){

            $eslaider = array("panoramica1.jpg","panoramica4.jpg","panoramica3.jpg");
            return $eslaider;                   
            
        }        

        public function get_ferrocarril(){

            $query = "START n=node(".$this->id_sitio.") MATCH n<-[:Semejantes]->b RETURN b;";
            
            $resultado = $this->modelsitios->get_semejantes($query);
            $resultado = array();
            if(count($resultado)<10){
                $query = "START n=node(*) WHERE n.type='Sitio' RETURN n;";
                $resultado2 = $this->modelsitios->get_sitio_aleatorio($query, 10 - count($resultado));
            }
            
            $final = array_merge($resultado, $resultado2);
            
            return $final;            
        }        
        
        
        public function get_visitantes(){   
            
            $query = "START n=node(".$this->id_sitio.") MATCH n<-[:Fan]-b RETURN b;";            
            $resultado = $this->modelusuario->get_visitantes($query);

            return $resultado;
            
        }          
        
        public function get_gustaria(){   
            
            $query = "START n=node(".$this->id_sitio.") MATCH n<-[:Desea]-b RETURN b;";            
            $resultado = $this->modelusuario->get_desean($query);
            return $resultado;
            
        } 
        
        public function get_coordenadas_mapa(){
            
            $query = "START n=node(".$this->id_sitio.") RETURN n";
            //$resultado = $this->modelsitios->get_property_mapa($query);
            $resultado = $this->modelsitios->get_sitio($query);

            return $resultado;                        
        } 
        /*
        public function get_coordenadas_mapa(){            
            $query = "START n=node(".$this->id_sitio.") RETURN n.latitud,n.longitud";
            $resultado = $this->modelsitios->get_property_mapa($query,"latitud","longitud");
            return $resultado;                        
        }      */   

    }