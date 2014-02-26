<?php 
    
    require_once 'galeriaVista.php';    
    require_once 'galeriaModel.php';

    session_start();
    

    class Galerias{

        public $vista;
        public $modelo;
        
        
        public function __construct() {
            
                $this->vista = new GaleriaVista();
                $this->modelo = new GaleriaModel();
        }       
        
        
        public function fotos($id, $galeria){

            if($galeria == 0)
                $resutlados = $this->modelo->get_img_asociadas($id);
                //$resutlados = $this->modelo->get_img_todas($id);
            else
                $resutlados = $this->modelo->get_img_empresas($id);
            
            
            return $resutlados;
        }
        
        
        /* Esta funcion valida el tipo de elemento que 
         * esta solicitando su galeria.
         *  
         * retorna 0 si el id no pertenece a un sitio o empresa
         * 
         * retorna 1, si es un sitio o 2 si es una empresa
         */

        public function validar($id){
            
            if($this->modelo->validar_sitio($id))                
                return 1;
            elseif ($this->modelo->validar_empresa($id))                
                return 2;            
            
                        
            return 0;
        }
    
        
        public function nombre_padre($id){
            
            $nombre = $this->modelo->traer_nombre($id);            
            return $nombre;            
        }
        
        
        
        public function main($id, $url_padre, $galeria){
            
            $this->vista->refactory_header(1); 
            $this->vista->refactory_fotos($this->fotos($id, $galeria));            
            $this->vista->refactory_galeria($id, $url_padre,$this->nombre_padre($id));
            //$this->vista->refactory_albun();
            $this->vista->refactory_resultados_total();
            
        }
    }

    
    
    
    

    $id = $_GET['id'];
    $galeria = new galerias();
    
    $validar = $galeria->validar($id);
    
    if($validar){
        
        if($validar==1){
             $galeria->main($id, "{url_sitio}", 0);
            
        }else{
            
            $galeria->main($id, "{url_empresa}", 1);
        }
        
    }else{
        
        
    }


?>