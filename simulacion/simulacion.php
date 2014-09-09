<?php    
    
    require_once('../core/coneccion.php');
    require_once('../core/modeloUsuario.php');
    include_once 'simulacionVista.php';
    include_once 'simulacionModel.php';

    
    class SimulacionControl{        
        
        public $vista;
        public $modelo;
        public $mUsuario;
        
        public function __construct() {
            
            $this->vista = new SimulacionVista();
            $this->modelo = new ModelSimulacion();
            $this->mUsuario = new ModelUsuarios();
                         
        }
        
        
        public function mostrarTabla($siDatos){
            
            $this->vista->generarTabla($siDatos);
        }
        
        
        public function generarDatosAleatorios(){
            
            
        }
        
        
        public function ejecutarUsuario(){
            
            $iter = 100;
            $busqueda ="julian";
            $media = 0;
            $desvi = 0;
            $time= array();
            
            for($i = 0; $i<$iter; $i++){
                $time_start = microtime(true);
                $res = $this->mUsuario->prueba_usuario($busqueda);
                $time_end = microtime(true);
                $time[$i] = ($time_end - $time_start);
                
                $media+= $time[$i];
            }
            
            $media = ($media/$iter);
            
            for($i = 0; $i<$iter; $i++){
                $desvi += pow($time[$i] - $media , 2);
            }
            
            $desvi = sqrt($desvi / ($iter - 1))*1000;
            $media = $media*1000;
            
            echo "<script>alert('media: ".$media." desvi:".$desvi."')</script>";
                       
            
            
        }

        public function principal_simulacion(){
            
//            
//            for($i=1; $i<5; $i++)
//                echo " ".$this->modelo->get_cantidadNodos($i);
//            $this->mostrarTabla(false);
//            $this->ejecutarUsuario();
            $this->vista->generarTabla(0);
            $this->vista->refactory();
        }

    }
    

    $obje = new SimulacionControl();    
    

        
        $obje->principal_simulacion();
        






?>







