<?php

    include_once '../../../core/modeloSitio.php';
    include_once ('../../../core/modeloPublicacion.php');
    include_once ('../../../core/modeloUsuario.php');
    include_once ('../../../core/modeloNodos.php');
    include_once ('../../../core/modeloEmpresa.php');
    include_once ('../../../core/ConexionMysql.php');
    
    require_once('../../../core/coneccion.php');
    require_once('../../../core/Sitio.php');
    require_once '../../../core/global_var.php';    

    include_once 'consultasSimulacion.php';

    require_once('../../../core/coneccion.php');



use Everyman\Neo4j\Node,
    Everyman\Neo4j\Index,
    Everyman\Neo4j\Query\ResultSet,
    Everyman\Neo4j\Relationship,
    Everyman\Neo4j\Cypher,
    Everyman\Neo4j\Cypher\Query,
    Everyman\Neo4j\Command;


    class ModelSimulacion{       
        
        
        public $modelsitios;
        public $modelempresas;
        public $modelusuarios;
        public $modelnodos;
        public $conexion;
        
        public function __construct() {
        
            $this->modelsitios = new ModelSitios();
            $this->modelempresas= new ModelEmpresa();
            $this->modelusuarios = new ModelUsuarios();
            $this->conexion = new Conexion();
//            
        
        }
        
        /**
         * Funcion para realizar prueba de rendimiento del motor de bases de datos.
         * @param String $queryString
         * @return array
         */
        public function pruebaMotor($queryString){
                         
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();            
            
            if($result) return true;
            else return false;
            
        }        
        
      
        
        
        public function get_sitios(){   
            
            $query = "START n=node(*) WHERE n.type='Sitio' RETURN n;";            
            $resultado = $this->modelsitios->get_sitio_aleatorio($query, 3);

            return $resultado;
            
        }                

        public function get_empresas(){   
            
            $query = "START n=node(*) WHERE n.type='Empresa' RETURN n;";            
            $resultado = $this->modelempresas->get_empresa_aleatorio($query, 3);

            return $resultado;
            
        }                        
        
        public function get_usuarios(){   
                        
            $query = "START n=node(*) WHERE n.type='Usuario' RETURN n";            
            $resultado = $this->modelusuarios->get_usuarios_aleatorios($query,3);
        
            return $resultado;            
        }     

        public function insertar_datos($idTabla, $tipo , $nodo, $prueba){

            $consulta ="";
            if($tipo == "usuario")
                $consulta ="START a=node(".$nodo->id.") MATCH a-[:Amigo]->b-[:Amigo]->c RETURN b";
            else if($tipo == "empresa")
                $consulta ="START e=node(".$nodo->id.") MATCH e<-[:Cliente]-u1<-[:Amigo]-u2 RETURN u2";            
            else                
                $consulta ="START s=node(".$nodo->id.") MATCH s<-[:Asociada]-e-[:Img]->i<-[:Sobre]-c RETURN c";
            

                $insert = "INSERT INTO simulacion
                        (id,
                        prueba,
                        tipo_nodo,
                        id_nodo,
                        consulta,
                        tiempo)
                        VALUES
                        (".$idTabla.",
                        '".$prueba."',
                        '".$tipo."',
                        '".$nodo->id."',
                        '".$consulta."',
                        '');";                                        
            
            $this->conexion->ejecutar_query($insert);

        }

        
        public function generarPrueba($prueba){
            
            
            
            $queri = 'start n=node(*) Where n.type = "Usuario" return n';
            $user = $this->modelusuarios->get_usuarios_aleatorios($queri, 1);
             
             
            $queri = 'start n=node(*) Where n.type = "Empresa" return n';
            $empres = $this->modelempresas->get_empresa_aleatorio($queri, 1);                        
            
            $queri = 'start n=node(*) Where n.type = "Sitio" return n';
            $sitio = $this->modelsitios->get_sitio_aleatorio($queri, 1);            
            
            $idTabla = $this->conexion->get_resultados_query("SELECT MAX(id) AS id FROM simulacion");
            $idTabla[0]['id'] ++;                            
     
            $this->insertar_datos($idTabla[0]['id'], "sitio", $sitio[0], $prueba);
            $this->insertar_datos($idTabla[0]['id'], "usuario", $user[0], $prueba);
            $this->insertar_datos($idTabla[0]['id'], "empresa", $empres[0], $prueba);
        

            
        }

        public function ejecutarPrueba(){
            
            $sql = "SELECT * FROM simulacion where id=(select max(id) from simulacion)";                      
            $ultimos  = $this->conexion->get_resultados_query($sql);                                             
            $i=0;
            
            foreach ($ultimos as $valor){                               
                
                $media =0;
                for($c = 0; $c<100; $c++){
                    $time_start = microtime(true);
                    $res = $this->pruebaMotor($valor['consulta']);
                    $time_end = microtime(true);
                    $time = ($time_end - $time_start);
                    
                    $media+= $time;
                }                       
                                
                $media = ($media/100)*1000;
                $media = round($media, 3);
                $update = "UPDATE simulacion SET  tiempo = '".$media."' WHERE  id = ".$valor['id']." AND  tipo_nodo =  '".$valor['tipo_nodo']."';"; 
                $res = $this->conexion->ejecutar_query($update);
                
            }
            
            
        }


        
        public function get_cantidadNodos($query){
                        
            $consulta = new Cypher\Query(Neo4Play::client(), $query);
            $result = $consulta->getResultSet();     
            
            foreach ($result as $row){
                
                $resultado = $row[0];
            }                  
                        
            return $resultado;            
        
        }        
        
        
        
        public function cargarPrueba($prueba){
            
            
            
            
            
            
            
            
            
            $query = "START n=node(*) where n.type='Usuario' RETURN count(n)";
            
            $arrayNodos=array(
                        'Total'=>'',
                        'Usuario'=>'',
			'Sitio'=>'',
			'Empresa'=>'',
			'Experiencia'=>'',
			'Imagen'=>'',
			'Comentario'=>'',
			'Servicio'=>'',
			'Administrador'=>'',
			'Noticia'=>'',
			'Evento'=>'');          
            
            $cyper = "";

            foreach ($arrayNodos as $clave=>$valor){

                if($clave == "Total"){
                    $cyper = "START n=node(*) RETURN count(n)";
                }else{ 
                    $cyper = "START n=node(*) where n.type='".$clave."' RETURN count(n)";
                }

                $arrayNodos[$clave] = $this->get_cantidadNodos($cyper);
            }
                 
//            
//            foreach ($arrayNodos as $clave=>$valor){
//
//                echo $clave.": ".$valor."<br>";
//            }            
//            
//            
            
            return $arrayNodos;
                    
            
            
        }
        
        public function analisisFinal($prueba){
            
            $json = array(
                array(
                    "promedio"=>"",
                    "desviacion"=>""                    
                ),
                array(
                    "promedio"=>"",
                    "desviacion"=>""                    
                ),
                array(
                    "promedio"=>"",
                    "desviacion"=>""
                )                
            );

            
            foreach ($json as $array){
                
                
                
                
            }
            
            
            
        }
        
    }   

//    
//    $obj = new ModelSimulacion();
//    
//    $datos = $obj->cargarPrueba(1000);    
    
    
    
    

if(isset($_GET['opcion'])){
    
    $datos = array();
    $opcion = $_GET['opcion'];
    $prueba = $_GET['cant'];    
    
            
    switch ($opcion){
       
        // Registro de un Usuario
        case 'genPrueba':                                   
            
            $obj = new ModelSimulacion();
            $obj->generarPrueba($prueba);           
            

            $conecta = new Consultas();            
            $registros = $conecta->ListaRegistros();
            
            foreach ($registros as $value){                                                                
                
                $fila = array(
                    "id"=> $value['id'],
                    "prueba"=> $value['prueba'],
                    "tipo_nodo"=> $value['tipo_nodo'],
                    "id_nodo"=> $value['id_nodo'],
                    "consulta"=> $value['consulta'],
                    "tiempo"=> $value['tiempo']
                );

                array_push($datos, $fila);                        
            }
            
            $datos = json_encode($datos);
            
            
        break;
        
        case 'ejecPrueba':                                   
            
            $obj = new ModelSimulacion();
            $obj->ejecutarPrueba($prueba);                                 
            
            $conecta = new Consultas();            
            $registros = $conecta->ListaRegistros();
            
            foreach ($registros as $value){                                                                
                
                $fila = array(
                    "id"=> $value['id'],
                    "tipo_nodo"=> $value['tipo_nodo'],
                    "prueba"=> $value['prueba'],
                    "id_nodo"=> $value['id_nodo'],
                    "consulta"=> $value['consulta'],
                    "tiempo"=> $value['tiempo']
                );

                array_push($datos, $fila);                        
            }
            
            $datos = json_encode($datos);
            
            
        break;        
        
        case 'cargaPrueba':                                   
            
            $obj = new ModelSimulacion();                        
            $datos = $obj->cargarPrueba($prueba);                                 
            
            $datos = json_encode($datos);
            
            
        break;       
    
        case 'final':  
            
            $obj = new ModelSimulacion();                        
            $datos = $obj->analisisFinal($prueba);                                 
            
            $datos = json_encode($datos);
            
            
        break;        
                    
                
      
        default : break; 
    }    
    
    echo $datos;
}

?>