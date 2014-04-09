<?php 
    
    require_once 'consultaVista.php';    
    require_once 'consultaModel.php';

    

    class consulta{

        public $vista;
        public $modelo;
        
        
        public function __construct($buscar) {            
            $this->vista = new ConsultaVista();
            $this->modelo = new ConsultaModel($buscar);            
        }       
        
        
        public function resultado(){
            $resutlados = $this->modelo->get_resultados();
            return $resutlados;            
        }
        
        
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