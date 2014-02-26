<?php
    
    require_once('../../core/modeloAdministrador.php');    
    require_once('../../core/modeloPublicacion.php');    
    require_once('../../librerias/neo4jphp.phar');
    require_once('../../librerias/Neo4Play.php');    
    

    class AdministradorModel{
        
        public $modeladministrador;
        public $modelpublicacion;
        public $id_user;
        
        
        public function __construct($id) {
            
            $this->modeladministrador = new ModelAdministrador();
            $this->modelpublicacion = new ModelPublicacion();
            $this->id_user = $id;
            
        }       
        
        
        public function get_admin(){   
                        
            $query = "START n=node(".$this->id_user.") RETURN n";            
            $resultado = $this->modeladministrador->get_administrador($query);

            return $resultado;            
        }  
        
        public function get_noticias(){   
                        
            $query = "START n=node(".$this->id_user.") MATCH n-[:Informa]->b WHERE b.type='Noticia' return b";            
            $resultado = $this->modelpublicacion->get_noticias($query);

            return $resultado;            
        }          
              
        public function get_eventos(){   
                        
            $query = "START n=node(".$this->id_user.") MATCH n-[:Informa]->b WHERE b.type='Evento' return b";            
            $resultado = $this->modelpublicacion->get_eventos($query);

            return $resultado;            
        }                  
        
    }