<?php

    require_once('../../core/modeloUsuario.php');
    require_once('../../librerias/neo4jphp.phar');
    require_once('../../librerias/Neo4Play.php');    
    
    
    class LoginModel{
        
        public $modelusuario;
             
        
        public function __construct() {
                    
            $this->modelusuario = new ModelUsuarios();
            
        }
        
        
        
        
        public function exite_usuario($user){           
            
            
            return $this->modelusuario->get_id($user, "correo");
            

            
        }
        
        
        public function get_pass($id_user){           
            
            
            return $this->modelusuario->get_pass($id_user);
            

            
        }        
        
        
    }
    




?>

