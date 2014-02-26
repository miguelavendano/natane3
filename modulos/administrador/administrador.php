<?php 
    require_once 'administradorVista.php';    
    require_once 'administradorModel.php';
    require_once '../../core/Validar.php';
    require_once '../login/loginControl.php';

    

    class Administradores{

        public $vista;
        public $modelo;
        
        
        public function __construct($id) {            
            $this->vista = new AdministradorVista($id);
            $this->modelo = new administradorModel($id);
        }       
        
        
        public function datos_administrador(){
            $usuario = $this->modelo->get_admin();            
            return $usuario;            
        }
        
        public function noticias(){            
            return $this->modelo->get_noticias();            
        }

        public function eventos(){            
            return $this->modelo->get_eventos();            
        }        

        public function principal_Nousuario(){
            
        }        
        
        public function principal_Nologin(){
            
        }       
              
        
        
        /**
         * funcion principal que organiza y estructura el todo
         * 
         * @param int $login valor numerico que indica el tipo de login que hay
         * 1->loguado y  es el dueño. 2: logueado y no es el dueño y 3:no esta logueado. 
         */
        public function principal_administrador($login){
            
            $this->vista->refactory_header($login); 
            $this->vista->refactory_administrador($this->datos_administrador());          
            $this->vista->refactory_noticias($this->noticias());
            $this->vista->refactory_eventos($this->eventos());          
            $this->vista->refactory_contenido();
            $this->vista->refactory_total();
            
        }
    }

    
    
    $id = $_GET['id'];

    $validar = new Validar();

    if($validar->validar_id($id, "Administrador")){    // el id del nodo corresponde a un Administrador ?

        $admin = new Administradores($id);
        
        if(isset($_SESSION['id'])){ // existe sesion ?                                   
            
            if(Login::acceso_Pusuario($id)){  //El usr logueado es el dueño de este perfil ?
                
                $admin->principal_administrador(1);

            }else{

                $admin->principal_administrador(2);
                
            }
        }else{
            
            $admin->principal_administrador(3);
        }

    }else{

        header('Location: /natane3/Index/');
    }  
    

?>
