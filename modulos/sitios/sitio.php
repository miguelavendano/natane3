<?php 
    require_once 'sitioVista.php';    
    require_once 'sitioModel.php';
    require_once '../../core/Validar.php';
    require_once '../login/loginControl.php';


    class Sitios{

        public $vista;
        public $modelo;        
        
        
        public function __construct($id) {            
            $this->vista = new SitioVista($id);
            $this->modelo = new SitioModel($id);
        }       
        
        
        public function datos_contacto(){
            $contacto = $this->modelo->get_contacto();            
            return $contacto;
        }
        
        public function slider_sitio(){
            $slider = $this->modelo->get_slider();            
            return $slider;
        }        

        public function ferrocarril(){
            $ferro = $this->modelo->get_ferrocarril();           
            return $ferro;
        }        
        
        
        public function visitantes(){            
            return $this->modelo->get_visitantes();
        }
        
        
        public function desean(){            
            return $this->modelo->get_gustaria();            
        }
        

        public function coordenadas(){            
            return $this->modelo->get_coordenadas_mapa();            
        }
        
        
        public function principal_sitio($login){            
            
            $this->vista->refactory_header( $login );
            $this->vista->refactory_slider( $this->slider_sitio() );
            $this->vista->refactory_contacto( $this->datos_contacto() );
            $this->vista->refactory_visitantes( $this->visitantes() );
            $this->vista->refactory_gustaria( $this->desean() );
            $this->vista->refactory_ferrocarril( $this->ferrocarril() );            
            $this->vista->refactory_mapa( $this->coordenadas() );  
            $this->vista->refactory_contenido();                                  
            $this->vista->refactory_total();            
        }
    }

    
    
    //session_start();

    $idsitio = $_GET['id'];
    $validar = new Validar();

    if($validar->validar_id($idsitio, "Sitio")){
        $sitio = new Sitios($idsitio);              
        
        if(isset($_SESSION['id'])){ // existe sesion ?                                               
            if(Login::acceso_Susuario($idsitio)){  //El usr logueado es el dueño de este sitio ?
                
                $sitio->principal_sitio(1);

            }else{

                
                $sitio->principal_sitio(2);
                
            }
        }else{
            
            $sitio->principal_sitio(3);
        }        
        
        
    }else{
        header('Location: /natane3/Index/');
    }

?>