<?php 
    
    require_once 'imagenVista.php';    
    require_once 'imagenModel.php';

    session_start();
    
    class Imagenes{

        public $vista;
        public $modelo;
        
        
        public function __construct() {
                
                $this->vista = new ImagenVista();
                $this->modelo = new ImagenModel();            
        }       
        
        
        public function imagen($id){
            $resutlados = $this->modelo->get_imagen($id);
            return $resutlados;
        }
        
        public function comentarios($id){
            $resutlados = $this->modelo->get_comentarios($id);
            return $resutlados;                   
        }        
                
        
        public function principal_imagen($id, $login){
            
            $this->vista->refactory_header($login); 
            $this->vista->refactory_imagen($this->imagen($id));            
            $this->vista->refactory_comentarios($this->comentarios($id));
            $this->vista->refactory_total();
            
        }
    }
    
    
   
    $id = $_GET['id'];
    $imagen = new Imagenes();    
    $login = false;       
    
    if(isset($_SESSION['id'])) // existe sesion ?
        $login = true;
    
    
    $imagen->principal_imagen($id, $login);
        

        
        

    
    
    
    
    
    

?>