<?php    
    session_start(); 
    require_once('../core/coneccion.php');
    include_once 'indexVista.php';
    include_once 'indexModel.php';

    
    class IndexControl{
        
        private $imag_slier;      
        public $vista;
        public $modelo;
        
        public function __construct() {
            
            $this->vista = new IndexVista();
            $this->modelo = new ModelIndex();
                        
        }
        
        public function slider(){                                
            
                      
            $slider = array();            
            $slider = $this->modelo->get_slider();            
                        
            return $slider;
        }
               
        
        public function ferrocarril(){

            return $this->modelo->get_carrusel();
                        
        }

        
        public function principal_index($login){
            
            $this->vista->refactory_header($login); 
            $this->vista->refactory_slider($this->slider());                        
            $this->vista->refactory_ferrocarril($this->ferrocarril());                        
            $this->vista->refactory_index();
            $this->vista->refactory();

        }

    }
    


    
    $obje = new IndexControl();
    
        
    if(isset($_SESSION['id'])){ // existe sesion ?                                           

        $obje->principal_index(1);

    }else{

        $obje->principal_index(0);

    }





?>







