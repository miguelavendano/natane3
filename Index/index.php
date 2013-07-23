<?php
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

        
        public function main(){
            
            echo "probando 1 main";
            $this->vista->refactory_slider($this->slider());                        
            $this->vista->refactory_ferrocarril($this->ferrocarril());                        
            echo "probando 2 main";
            $this->vista->refactory_index();
            $this->vista->refactory();

        }

    }
    
   
$obje = new IndexControl();
$obje->main();


?>







