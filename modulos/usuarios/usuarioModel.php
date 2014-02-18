<?php
    
    require_once('../../core/modeloUsuario.php');    
    require_once('../../core/modeloExperiencia.php');
    require_once('../../core/modeloSitio.php');    
    require_once('../../librerias/neo4jphp.phar');
    require_once('../../librerias/Neo4Play.php');    
    

    class UsuarioModel{
        
        public $modelusuarios;
        public $modelexpe;
        public $modelsitio;
        public $id_user;
        
        
        public function __construct($id) {
            
            $this->modelusuarios = new ModelUsuarios();
            $this->modelexpe = new ModelExperiencia();
            $this->modelsitio = new ModelSitios();
            $this->id_user = $id;
            
        }       
        
        public function get_seguidores(){   
                        
            $query = "START a=node(".$this->id_user.") MATCH a<-[:Amigo]-b RETURN b;";            
            $resultado = $this->modelusuarios->get_amigos($query);

            return $resultado;            
        }          
        
        public function get_siguiendo(){   
                        
            $query = "START a=node(".$this->id_user.") MATCH a-[:Amigo]->b RETURN b;";            
            $resultado = $this->modelusuarios->get_amigos($query);

            return $resultado;            
        }                  
        
        public function get_resultados(){   
                        
            $query = "START n=node(".$this->id_user.") RETURN n";            
            $resultado = $this->modelusuarios->get_usuario($query);

            return $resultado;            
        }  
        
        public function get_experiencias(){   
                        
            $query = "start n=node(".$this->id_user.") match n<-[:Comparte|Etiqueta]->b return b;";            
            $resultado = $this->modelexpe->get_exper_usuario($query);

            return $resultado;            
        }          
        
        public function get_visitaria(){   
            
            $query = "start n=node(".$this->id_user.") match n<-[:Desea]->b return b;";            
            $resultado = $this->modelsitio->get_sitio($query);

            return $resultado;
        }   

        public function get_AmigosDeAmigos(){   
            
            //$query = "start n=node(".$this->id_user.") match n<-[:Amigo]->a<-[:Amigo]->o return o";
            $query = "START n=node(".$this->id_user.") MATCH n-[:Amigo]->a<-[:Amigo]->o return o";
            //$query = "start n=node(".$this->id_user.") match n<-[:Amigo]->a return a";
            $resultado = $this->modelusuarios->get_AmigosDeAmigos($query);

            return $resultado;
        }           
        
//        public function get_usuario_gustaria($queryString){           
//            
//            $query = new Cypher\Query(Neo4Play::client(), $queryString);
//            
//            $result = $query->getResultSet();
//            
//            $array = array();
//            
//            if($result){
//                
//            
//                foreach($result as $row) {
//                    $sitio = new Sitio();
//                    $sitio->id = $row['']->getId();
//                    $sitio->nick = $row['']->getProperty('nick');
//                    $sitio->imagen = $row['']->getProperty('imagen');
//                    array_push($array, $sitio);
//                    
//                    
//                }
//                return $array;
//            }
//
//                    
//            
//        }        
        
    }