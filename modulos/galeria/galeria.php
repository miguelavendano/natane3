<?php 
    
    require_once 'galeriaVista.php';    
    require_once 'galeriaModel.php';

    

    class Galerias{

        public $vista;
        public $modelo;
        
        
        public function __construct() {
                
                $this->vista = new GaleriaVista();
                $this->modelo = new GaleriaModel();
    
            
        }       
        
        
        public function fotos($id){

            $resutlados = $this->modelo->get_img_todas($id);
            
            
            return $resutlados;
            
            
        }
        
        public function validar_sitio($id){
            
            $boleano = $this->modelo->validar($id);
            
            if($boleano){
                return 1;
            }
            
        }
        
        
        
        public function main($id){
            
            $this->vista->refactory_fotos($this->fotos($id));
            $this->vista->refactory_albun();
            $this->vista->refactory_resultados_total();
            
        }
    }


    $id = $_GET['id'];
    $galeria = new galerias();
    
    if($galeria->validar_sitio($id)==1){        
        
        $galeria->main($id);
        
    }
    




?>