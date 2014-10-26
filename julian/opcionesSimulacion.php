<?php
session_start();
//require_once('../../core/coneccion.php');
include_once 'coneccion.php';
include_once 'consultasSimulacion.php';


if(isset($_POST['opcion'])){
    
    $datos = array();
    $opcion=$_POST['opcion'];
            
    switch ($opcion){
      
        case "milU":                       
            
            $conecta = new Consultas();            
            $registros = $conecta->ListaRegistros();
            
            foreach ($registros as $value){                                                                
                
                $fila = array(
                    "nodo"=> $value['nodo'],
                    "consulta1"=> $value['consulta1'],
                    "consulta2"=> $value['consulta2'],
                    "consulta3"=> $value['consulta3'],
                    "tConsulta1"=> $value['Tc1'],
                    "tConsulta2"=> $value['Tc2'],
                    "tConsulta3"=> $value['Tc3'],
                    "tPromedio"=> $value['Tpromedio']                              
                );

                array_push($datos, $fila);                        
            }
            
            $datos = json_encode($datos);           
            
        break;
        
        
        case "resultados":                       
            
            $conecta = new Consultas();            
            $registros = $conecta->ListaRegistros();
            
            foreach ($registros as $value){                                                                
                
                $fila = array(
                    "nodo"=> $value['nodo'],
                    "cantidad"=> $value['cantidad'],                    
                    "consulta1"=> $value['consulta1'],
                    "consulta2"=> $value['consulta2'],
                    "consulta3"=> $value['consulta3'],
                    "tConsulta1"=> $value['Tc1'],
                    "tConsulta2"=> $value['Tc2'],
                    "tConsulta3"=> $value['Tc3'],
                    "tPromedio"=> $value['Tpromedio']                              
                );

                array_push($datos, $fila);                        
            }
            
            $datos = json_encode($datos);           
            
        break;        
      
        default : break; 
    }    
    
    echo $datos;
}

?>