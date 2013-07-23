<?php 
    require_once 'empresaVista.php';    
    require_once 'empresaModel.php';
    require_once '../../core/Validar.php';

    

    class Empresas{

        public $vista;
        public $modelo;
        
        
        public function __construct() {
            
            $this->vista = new EmpresaVista();
            $this->modelo = new EmpresaModel();
            
        }       
        
        
        public function datos_contacto(){

            $contacto = $this->modelo->get_contacto();
            
            return $contacto;
            
        }
        
        public function slider_empresa(){

            $slider = $this->modelo->get_slider();
            
            return $slider;
            
        }        

        public function ferrocarril(){

            $ferro = $this->modelo->get_ferrocarril();
            
            return $ferro;
            
        }        
        
        
        public function gustaria(){
            
            return $this->modelo->get_gustaria();
            
        }        
        
        
        public function seguidores(){
            
            return $this->modelo->get_seguidores();
            
            
        }
        
        public function servicios(){

            $resutlados = $this->modelo->get_servicios();
            
            
            return $resutlados;
            
            
        }   
        
        public function experiencias(){
            
            return $this->modelo->get_experiencias();
            
        }        
        
        
        
        public function main(){
            
            $this->vista->refactory_slider( $this->slider_empresa());
            $this->vista->refactory_contacto( $this->datos_contacto());
            $this->vista->refactory_seguidores( $this->seguidores());
            $this->vista->refactory_gustaria( $this->gustaria());
            $this->vista->refactory_ferrocarril( $this->ferrocarril());            
            $this->vista->refactory_servicios($this->servicios());
            $this->vista->refactory_experiencias($this->experiencias());
            $this->vista->refactory_contenido();
            $this->vista->refactory_total();
            
        }
    }


//    $id = $_GET('id');
//    $validar = new Validar();
//    
//    if($validar->validar_id($id, "Usuario")){     
//        
        $empresas = new Empresas();
        $empresas->main();
        
//    }else{
//        
//        header('Location: /natane3/Index/');
//    }    
//    
//    
?>
