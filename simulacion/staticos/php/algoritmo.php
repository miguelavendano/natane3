<?php

    include_once ('../../../core/ConexionMysql.php');
    include_once ('../neo4j/creaUsuario.php');

class Algoritmo{
    
    public $mysql;
    public $totalNodos;
    public $i;
    
    
    public function __construct($total){
        
        $this->totalNodos = $total;
        $this->i= 0;
        $this->mysql = new Conexion();
        
        echo "hola1";
        
    }

    
    public function cargaUsuarios(){
        
        
        echo "hola2";
        $sexo=['M','F'];        
        $s=rand(0,1);
        $gen=$sexo[$s];        
        
        $nombres = $this->mysql->get_resultados_query("select nombre FROM nombres;");
        $apellidos = $this->mysql->get_resultados_query("SELECT apellido FROM natane.apellidos;");
        
        
        echo "hola3";
        for($this->i; $this->i < $this->totalNodos*0.25; $this->i++ ){
        
            $nom = $nombres[rand(0, count($nombres)-1)]['nombre'];
            $ape = $apellidos[rand(0, count($apellidos)-1)]['apellido'];        
            $nik=substr($nom,0,3)."_".substr($ape,0,3);         
            $mail=substr($nom,0,3)."_".substr($ape,0,3)."@gmail.com";           
            $img = "usuario".$this->i.".jpg";
            
            
            

            creaNodoUsuario($nom,$ape,$img,$gen,$nik, "villavo","granada",$mail);
            
        }
        
        echo "hola5";
    
    }




}


echo "hola0";
$obj = new Algoritmo(100);
$obj->cargaUsuarios();






?>
