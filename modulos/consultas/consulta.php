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
        
        
        public function main(){            
            $this->vista->refactory_elementos($this->resultado());
            $this->vista->refactory_resultados_total();            
        }
    }

    $busqueda = $_GET['busqueda'];
    
    $consulta = new consulta($busqueda);
    $consulta->main();

?>