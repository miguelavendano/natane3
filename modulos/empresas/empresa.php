<?php 
    require_once 'empresaVista.php';    
    require_once 'empresaModel.php';
    require_once '../../core/Validar.php';
    require_once '../login/loginControl.php';

    

    class Empresas{

        public $vista;
        public $modelo;
        
        
        public function __construct($id) {            
            $this->vista = new EmpresaVista($id);
            $this->modelo = new EmpresaModel($id);            
        }       
        
        
        public function datos_contacto(){
            $contacto = $this->modelo->get_contacto();            
            return $contacto;            
        }
        
        
        public function slider_empresa(){
            $slider = $this->modelo->get_slider();            
            return $slider;            
        }        
        
        public function amigos(){            
            return $this->modelo->get_amigos();
        }

        
        public function clientes_aliados(){            
            return $this->modelo->get_clientes_aliados();            
        }                
        
        
        public function ferrocarril(){
            $ferro = $this->modelo->get_ferrocarril();            
            return $ferro;            
        }                
        
        
        public function servicios(){
            $resutlados = $this->modelo->get_servicios();                       
            return $resutlados;            
        }           
        
        
        public function experiencias(){
            return $this->modelo->get_experiencias();
        }                
        

        public function coordenadas(){            
            return $this->modelo->get_coordenadas_mapa();            
        }
        
        
        
        public function principal_empresa($login){    
            
            
            
            $this->vista->refactory_header( $login );
            $this->vista->refactory_slider( $this->slider_empresa());
            $this->vista->refactory_contacto( $this->datos_contacto());
            $this->vista->refactory_amigos( $this->amigos());
            $this->vista->refactory_clientes_aliados( $this->clientes_aliados());
            $this->vista->refactory_ferrocarril( $this->ferrocarril());            
            $this->vista->refactory_servicios($this->servicios());
            $this->vista->refactory_experiencias($this->experiencias());
            $this->vista->refactory_mapa( $this->coordenadas() );              
            $this->vista->refactory_contenido();
            $this->vista->refactory_total();            
        }
    }

//    session_start();

    $id = $_GET['id'];    
    $validar = new Validar();
    
    if($validar->validar_id($id, "Empresa")){             
        $empresa = new Empresas($id);        
                       
        if(isset($_SESSION['id'])){ // existe sesion ?                                    
            
            if(Login::acceso_Pempresa($id)){  //El usr logueado es el dueño de esta Empresa ?
                
                $empresa->principal_empresa(1);

            }else{

                $empresa->principal_empresa(2);
                
            }
        }else{
            
            $empresa->principal_empresa(3);
        }   
        
        
        
        
    }else{        
        header('Location: /natane3/Index/');
    }        
    
            
?>
