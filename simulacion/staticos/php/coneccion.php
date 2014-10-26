<?php
  
    class Coneccion{

        public $db_host = 'localhost';
        public $db_user = 'root';	
        public $db_pass = '123';        
        public $db_name = 'natane';
        public $coneccion;		
        
        public function Coneccion(){		
            
        }
        
        public function abrir_coneccion(){            
            $this->coneccion = new mysqli($this->db_host,$this->db_user, $this->db_pass, $this->db_name);            
        }
        
        public function cerrar_coneccion(){            
            $this->coneccion->close();
        }
        
        public function ejecutar_query($query){ // query de tipo delete, update y insert            
            $this->abrir_coneccion();
            $ret = $this->coneccion->query($query); // false o true
            $this->cerrar_coneccion();
            return $ret;
        }
        
        public function get_resultados_query($query){ // retorna los datos consultados            
            $this->abrir_coneccion();
			
			$this->coneccion->query("SET NAMES 'utf8'");
			
            $datos = $this->coneccion->query($query);
            if($datos){
                
                $retorno = array();
            
                while($row = $datos->fetch_array(MYSQLI_ASSOC)){                
                    $retorno[] = $row;
                }                      
            
                $this->coneccion->close();            
                return $retorno;
                
            }else{
                
                return $retorno="";
            }

        } 

    }


?>