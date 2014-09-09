<?php 
    require_once 'sitioVista.php';    
    require_once 'sitioModel.php';
    require_once '../../core/Validar.php';
    require_once '../login/loginControl.php';


    /**
     * Clase controlador principal del modulo Sitios.
     */        
    class Sitios{

        /**
         *Instancia de la clase vista.
         * @var SitioVista 
         */
        public $vista;
        
        /**
         *Instancia de la clase Modelo.
         * @var SitioModel 
         */        
        public $modelo;        
        
        
        /**
         * Constructor de la clase.
         * @param int $id id del Sitio a mostrar.
         */        
        public function __construct($id) {            
            $this->vista = new SitioVista($id);
            $this->modelo = new SitioModel($id);
        }       
        
        
        /**
         * Ejecuta el metoddo get_contacto() de la clase modelo.
         * @return Array
         */        
        public function datos_contacto(){
            $contacto = $this->modelo->get_contacto();            
            return $contacto;
        }
        
        /**
         * Ejecuta el metodo get_slider() de la clase modelo.
         * @return Array
         */        
        public function slider_sitio(){
            
            $slider = $this->modelo->get_slider();            
            
            if(count($slider)){
                return $slider;    
            }else {
                $img = $this->modelo->get_img_perfil();            
                return $img;    
            }
        }        

        /**
         * Ejecuta el metodo get_ferrocarril de la case modelo.
         * @return Array
         */                
        public function ferrocarril(){
            $ferro = $this->modelo->get_ferrocarril();           
            return $ferro;
        }        
        
        
        /**
         * Ejecuta el metodo get_visitantes de las clase modelo.
         * @return Array
         */                
        public function visitantes(){            
            return $this->modelo->get_visitantes();
        }
        
        
        /**
         * Ejecuta el metodo get_gustaria de las clase modelo.
         * @return Array
         */                
        public function desean(){            
            return $this->modelo->get_gustaria();            
        }
        
        /**
         * Ejecuta el metodo get_experiencias_visitantes() de las clase modelo.
         * @return Array
         */                
        public function experiencias_visitantes(){            
            return $this->modelo->get_experiencias_visitantes();            
            
        }        
       
        
        /**
         * Es el metodo principal que controla la interacción entre el modelo y la vista.
         * @param int login Valor que indica el estado de la sesion del usuario que desea ver el perfil de la empresa.
         */        
        public function principal_sitio($login){
            
            $this->vista->refactory_header( $login );
            $this->vista->refactory_slider( $this->slider_sitio() );
            $this->vista->refactory_contacto( $this->datos_contacto() );
            $this->vista->refactory_visitantes( $this->visitantes() );
            $this->vista->refactory_gustaria( $this->desean() );
            $this->vista->refactory_ferrocarril( $this->ferrocarril() );
            $this->vista->refactory_experiencias($this->experiencias_visitantes());
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
