<?php 
    require_once 'usuarioVista.php';    
    require_once 'usuarioModel.php';
    require_once '../../core/Validar.php';
    require_once '../login/loginControl.php';

    

    class Usuarios{

        public $vista;
        public $modelo;
        
        
        
        public function __construct($id) {
            
            $this->vista = new UsuarioVista();
            $this->modelo = new UsuarioModel($id);
            
            
        }       
        
        
        public function datos_usuario(){

            $usuario = $this->modelo->get_resultados();
            
            return $usuario;
            
        }
        
        public function experiencias(){
            
            return $this->modelo->get_experiencias();
            
        }

        public function gustaria(){
            
            return $this->modelo->get_gustaria();            
        }        
        
        
        public function amigos(){
            
            return $this->modelo->get_amigos();            
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
        public function principal_usuario($login){
            
            $this->vista->refactory_header($login); 
            $this->vista->refactory_usuario($this->datos_usuario());
            $this->vista->refactory_amigos($this->amigos());
            $this->vista->refactory_experiencias($this->experiencias());
            //$this->vista->refactory_gustaria($this->gustaria());
            $this->vista->refactory_contenido();
            $this->vista->refactory_total();
            
        }
    }

    
    
    $id = $_GET['id'];

    $validar = new Validar();

    if($validar->validar_id($id, "Usuario")){    // el id del nodo corresponde a un Usuario ?

        $usuario = new Usuarios($id);
        
        if(isset($_SESSION['id'])){ // existe sesion ?                                   
            
            if(Login::acceso_Pusuario($id)){  //El usr logueado es el dueño de este perfil ?
                
                $usuario->principal_usuario(1);

            }else{

                $usuario->principal_usuario(2);
                
            }
        }else{
            
            $usuario->principal_usuario(3);
        }

    }else{

        header('Location: /natane3/Index/');
    }        
    

?>
