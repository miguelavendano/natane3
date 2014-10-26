<?php 
    require_once 'empresaVista.php';    
    require_once 'empresaModel.php';
    require_once '../../core/Validar.php';
    require_once '../login/loginControl.php';

    

    /**
     * Clase controlador principal del modulo Empresas.
     */    
    class Empresas{

        /**
         *Instancia de la clase vista.
         * @var EmpresaVista 
         */
        public $vista;
        
        /**
         *Instancia de la clase Modelo.
         * @var EmpresaModel 
         */
        public $modelo;
        
        
        /**
         * Constructor de la clase.
         * @param int $id id del usuario visitante.
         */
        public function __construct($id) {            
            $this->vista = new EmpresaVista($id);
            $this->modelo = new EmpresaModel($id);            
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
        public function slider_empresa(){
            $slider = $this->modelo->get_slider();            
            return $slider;            
        }        
        
        
        /**
         * Ejecuta el metodo get_amigos() de la clase Modelo.
         * @return Array
         */
        public function amigos(){            
            return $this->modelo->get_amigos();
        }

        /**
         * Ejecuta el metodo get_clientes_aliados de las clase modelo.
         * @return Array
         */        
        public function clientes_aliados(){            
            return $this->modelo->get_clientes_aliados();            
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
         * Ejecuta el metodo get_servicios de la clase modelo.
         * @return Array
         */        
        public function servicios(){
            $resutlados = $this->modelo->get_servicios();                       
            return $resutlados;            
        }           
        
        
        /**
         * Ejecuta el metodo get_experiencias de la clase modelo.
         * @return Array
         */       
        public function experiencias(){
            return $this->modelo->get_experiencias();
        }                
        

        /**
         * Ejecuta el metodo get_coordenadas_mapa de la clase modelo.
         * @return Array
         */               
        public function coordenadas(){            
            return $this->modelo->get_coordenadas_mapa();            
        }
        

        /**
         * Ejecuta el metodo get_confianza_sitio de la clase modelo.
         * @return Array
         */               
        public function confiaEmpresa(){            
            return $this->modelo->get_confianza_sitio();            
        }        
          
        
        
        /**
         * Es el metodo principal que controla la interacción entre el modelo y la vista.
         * @param int $login Valor que indica el estado de la sesion del usuario que desea ver el perfil de la empresa.
         */
        public function principal_empresa($login){    
                       
            if($login==2){
                $this->vista->refactory_boton_confianza($this->confiaEmpresa());
                
            }
            
            $this->vista->refactory_header( $login );
            $this->vista->refactory_slider( $this->slider_empresa() );
            $this->vista->refactory_btn_admin_empresa( $login );
            $this->vista->refactory_contacto( $this->datos_contacto() );
            $this->vista->refactory_amigos( $this->amigos() );
            $this->vista->refactory_clientes_aliados( $this->clientes_aliados() );
            $this->vista->refactory_ferrocarril( $this->ferrocarril() );            
            $this->vista->refactory_servicios( $this->servicios(),$login );
            $this->vista->refactory_experiencias( $this->experiencias(), $login );
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
