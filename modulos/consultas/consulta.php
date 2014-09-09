<?php 
    
    require_once 'consultaVista.php';    
    require_once 'consultaModel.php';

    
    
    /**
     * Clase controlador principal del modulo de Consultas
     * 
     */
    class consulta{

        /**
         *Instancia de la clase vista.
         * @var ConsultaVista 
         */
        public $vista;
        /**
         *Instancia de la clase Modelo.
         * @var ConsultaModel 
         */
        public $modelo;
        
        /**
         * Inicializa las instacias Vista y Modelo
         * @param String $buscar
         */
        public function __construct($buscar) {            
            $this->vista = new ConsultaVista();
            $this->modelo = new ConsultaModel($buscar);            
        }       
        
        
        /**
         * Llama a al metodo get_resultados de la clase consultaModel
         * @return Array Contiene los datos consultados. 
         */
        public function resultado(){
            $resutlados = $this->modelo->get_resultados();
            return $resutlados;            
        }
        
        
        /**
         * Es el metodo principal donde se controla la interacciòn entre el modelo y la vista.
         * @param Boolean $login Parametro que indica si se encuentra una sesión iniciada (Frue o Flase).
         */
        public function principal_consulta($login){  
            
            $this->vista->refactory_header($login); 
            $this->vista->refactory_elementos($this->resultado());                            
            $this->vista->refactory_resultados_total();   
            
        }
    }
    
    session_start();

    $busqueda = $_GET['busqueda'];
    
    $consulta = new consulta($busqueda);
    
    

        if(isset($_SESSION['id'])){ // existe sesion ?                                   
            
            $consulta->principal_consulta(true);
        }else{
            
            $consulta->principal_consulta(false);    
    
        }
    
    
    
?>