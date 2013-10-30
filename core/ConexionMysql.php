<?php

    

    class Conexion{

        public  $db_host = 'localhost';
        public  $db_user = 'root';
        public  $db_pass = '123';
        public  $db_name = 'natane';
        public $conexion;
        
        
        public function Conexion(){
            
        }
        
        public function abrir_conexion(){
            
            $this->conexion = new mysqli($this->db_host,$this->db_user, $this->db_pass, $this->db_name);  
            
            
        }
        
        public function cerrar_conexion(){
            
            $this->conexion->close();
            
        }
        
        public function ejecutar_query($query){  // query de tipo delete, update y insert
            
            $this->abrir_conexion();
            $ret = $this->conexion->query($query);  // false o true
            $this->cerrar_conexion();
            return $ret;
        }
        
        public function get_resultados_query($query){  // retorna los datos consultados
            
            $this->abrir_conexion();
            $datos = $this->conexion->query($query);           
            
            $retorno = array();
            
            while($row = $datos->fetch_array(MYSQLI_ASSOC)){
                
                $retorno[] = $row;
            }
            
            
            
            $this->conexion->close();           
            return $retorno;            
            
        }

    }



?>
