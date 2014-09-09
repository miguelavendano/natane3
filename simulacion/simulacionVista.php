<?php
    require_once('../core/coneccion.php');
    require_once('../core/Sitio.php');
    require_once '../core/global_var.php';
    
    class SimulacionVista{

        public $base;        
        public $tabla;        
        public $diccionario;
        
        
        
        public function __construct() {
            
            $this->base = file_get_contents('staticos/base.html');
            $this->tabla = file_get_contents('staticos/plantillas/tabla.html');           
            

        }
        
        public function actualizar_diccionary(){
         

//            $this->diccionario = array('metas'=>$this->metas,
//                                        'links'=>$this->links,  
//                                        'head'=>$this->head,
//                                        'contenido'=>$this->file);   
            
            
            
        }   
        
        
        
        public function generarTabla($siDatos){
            
            $registros = "";
            
           // if ($siDatos) {
                $registros = file_get_contents('staticos/plantillas/registros.html');
           // }else{                
                $this->tabla = str_ireplace("{registros}", $registros, $this->tabla);
                $this->base = str_ireplace("{tabla}", $this->tabla, $this->base);
                
            //}           
            
        }

        
        public function refactory(){  // contruye todo insertando el contenido del index en la plantilla base
            
//            $this->actualizar_diccionary();
//            
//            $globales = new Global_var();
//            
//            
//            foreach($this->diccionario2 as $clave=>$valor){
//                
//                $this->base = str_ireplace('{'.$clave.'}', $valor, $this->base);
//
//                
//            }
//            
//            foreach ($globales->global_var as $clave => $valor){
//                $this->base = str_ireplace('{'.$clave.'}', $valor, $this->base);
//            }

            
            
            echo $this->base;          
            
        }
   

    }  

?>