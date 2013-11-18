<?php 
    
    require_once 'imagenVista.php';    
    require_once 'imagenModel.php';

    
    
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
                
        
        public function main($id){
            
            $this->vista->refactory_imagen($this->imagen($id));            
            $this->vista->refactory_comentarios($this->comentarios($id));
            $this->vista->refactory_resultados_total();
            
        }
    }
    
    

    $id = $_GET['id'];
    $imagen = new Imagenes();
    $imagen->main($id);  

    

?>