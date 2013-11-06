<?php 
    require_once 'usuarioVista.php';    
    require_once 'usuarioModel.php';
    require_once '../../core/Validar.php';

    

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
        
        public function main(){
            
            $this->vista->refactory_usuario($this->datos_usuario());
            $this->vista->refactory_amigos($this->amigos());
            $this->vista->refactory_experiencias($this->experiencias());
            //$this->vista->refactory_gustaria($this->gustaria());            
            $this->vista->refactory_contenido();
            $this->vista->refactory_total();
            
        }
    }

    session_start();
       
//    if(isset($_SESSION['id'])){        
//        if($_SESSION['id']==$_GET['id']){
//            
//            
//        }else{
//            
//            
//        }
//        
//    }
    

        $id = $_GET['id'];

        $validar = new Validar();

        if($validar->validar_id($id, "Usuario")){     

            $usuairo = new Usuarios($id);
            $usuairo->main();

        }else{

            header('Location: /natane3/Index/');
        }        
    

?>
