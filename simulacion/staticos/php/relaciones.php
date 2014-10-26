<?php

require_once('../../../core/coneccion.php');
require_once('../../../core/modeloRelaciones.php');
require_once('../../../core/modeloComentario.php');


use Everyman\Neo4j\Node,
    Everyman\Neo4j\Index,
    Everyman\Neo4j\Query\ResultSet,
    Everyman\Neo4j\Relationship,
    Everyman\Neo4j\Cypher,
    Everyman\Neo4j\Cypher\Query,
    Everyman\Neo4j\Command,
    Everyman\Neo4j\Exception;    



function traerTodos(){
    
    $cyper = "START n=node(*) return id(n) as id, n.type as type;";
    
    
            $query = new Cypher\Query(Neo4Play::client(), $cyper);
            $result = $query->getResultSet();
            
            
            
            $array = array();
            
            if($result){
            
                foreach($result as $row) {                   
                    
                    $arr = array(
                        'id'=>$row[0],
                        'type'=>$row[1]
                    );
                    
                    array_push($array, $arr);
                }
                
                return $array;
            }          
    
}


function consultaNodos($tipo){
    
    $cyper = "START n=node(*) where n.type='".$tipo."' return id(n);";
    
    
            $query = new Cypher\Query(Neo4Play::client(), $cyper);
            $result = $query->getResultSet();
            
            $array = array();
            
            if($result){
            
                foreach($result as $row) {                   
                    
                    $ids = $row[0];
                    
                    array_push($array, $ids);
                }
                
                return $array;
            }      
    
}

function traeRelaciones($idNodo){
    
    
    $miNodo = Neo4Play::client()->getNode($idNodo);
    $relaciones = $miNodo->getRelationships();            

    $array = array();
    
    foreach ($relaciones as $valor){
        
        $type = $valor->getType();
        
        array_push($array, $type);
        
    }
    
    return $array;
    
}


function cuentaRelacionesSegunTipo($idNodo,$tipoRelacion){    
    
    $miNodo = Neo4Play::client()->getNode($idNodo);
    $relaciones= $miNodo->getRelationships(array($tipoRelacion));

    return count($relaciones);   
    
}




function contarTipoRelacion($array, $tipo){
    
    $cont = 0;
    
    foreach ($array as $valor){
        
        if($valor == $tipo){
            $cont++;
        }
    }
    
    return $cont;
    
}





function crearRelaciones(){
    
    
    $control = array();
    echo "1";
    $usuarios = consultaNodos("Usuario");
    echo "2";
    $empresas = consultaNodos("Empresa");
    echo "3";
    $sitios = consultaNodos("Sitio");
    echo "4";
    $expe = consultaNodos("Experiencia");
    echo "5";
    $img = consultaNodos("Imagen");
    echo "6";
    $coment = consultaNodos("Comentario");
    echo "7";
    $serv = consultaNodos("Servicio");
    echo "8";

    
    
    
    $objRel = new ModeloRelaciones();
   
    
    
//    Img <- Comentarios
//    $tam = 0;
//    $tam = count($coment);
//    foreach ($img as $valor ){
//        
//        
//        
//        if($valor > 17881){
//              for($i=0; $i < rand(1, 3); $i++){
//
//                $aux = $coment[rand(0, $tam-1)];
//                $objRel->crearRelacion($aux, $valor, 'Sobre'); 
//                echo $aux."-Comentario  ---> Imagen-".$valor."<br>";
//            }
//            
//        }
            
            
            
            

        
        
//    }
    
//    Experiencia -> Imagen
//    $tam=0;     
//    $tam = count($img);
//    foreach ($expe as $valor ){
//        
//        for($i=0; $i < rand(1, 4); $i++){
//            
//            $aux = $img[rand(0, $tam-1)];
//            $objRel->crearRelacion($valor, $aux,  'Img'); 
//            echo $valor."-Experiencia  ---> Imagen-".$aux." <br>";
//        }
//        
//        
//    }    
    
    
//    Servicio ---> Imagen    
//    $tam=0;
//    $tam = count($img);
//    foreach ($serv as $valor ){
//
//        $aux = $img[rand(0, $tam-1)];
//        $objRel->crearRelacion($valor, $aux,  'Img'); 
//        echo $valor."-Servicio  ---> Imagen-".$aux." <br>";
//
//        
//        
//    }        
    
    
    
//    Sitio 1 <- * Experiencia
//    $tam=0;
//    $tam = count($expe);
//    foreach ($sitios as $valor ){
//        
//        for($i=0; $i < rand(1, 3); $i++){
//            
//            $aux = $expe[rand(0, $tam-1)];
//            $objRel->crearRelacion($aux, $valor, 'Asociada'); 
//            echo $valor."-Sitio  <--- Experiencia-".$aux." <br>";
//        }
//        
//        
//    }            
    
    
    
//    Empresa 1 -> * Experiencia
//    $tam=0;
//    $tam = count($expe);
//    foreach ($empresas as $valor ){
//        
//        for($i=0; $i < rand(1, 3); $i++){
//            
//            $aux = $expe[rand(0, $tam-1)];
//            $objRel->crearRelacion($valor, $aux, 'Comparte'); 
//            echo $valor."-Empresa  ---> Experiencia-".$aux." <br>";
//        }
//        
//        
//    }     
    
    
//    Empresa 1 -> * Servicio
//    $tam = 0;
//    $tam = count($serv);
//    foreach ($empresas as $valor ){
//
//        for($i=0; $i < rand(1, 3); $i++){
//            $aux = $serv[rand(0, $tam-1)];
//            $objRel->crearRelacion($valor, $aux, 'Ofrece'); 
//            echo $valor."-Empresa  ---> Servicio-".$aux." <br>";
//
//        }
//        
//    }       
    
    

////    usuarios 1 -> * usuarios
    
//    $tam = 0;
//    $tam = count($usuarios);
//    foreach ($usuarios as $valor ){
//        
//        for($i=0; $i < rand(1, 3); $i++){
//            
//            $aux = $usuarios[rand(0, $tam-1)];
//            $objRel->crearRelacion($valor, $aux, 'Sigue'); 
//            echo $valor."-usuarios  ---> usuarios-".$aux." <br>";
//        }
//        
//        
//    }     
    
  
    
//    usuarios 1 -> * Experiencias
    $tam = 0; 
    $tam = count($expe);
    foreach ($usuarios as $valor ){
        
        for($i=0; $i < rand(1, 3); $i++){
            
            $aux = $expe[rand(0, $tam-1)];
            $objRel->crearRelacion($valor, $aux, 'Comparte'); 
            echo $valor."-usuarios  ---> Experiencia-".$aux." <br>";
        }
        
        
    }         
    
    
    
//    usuarios 1 -> * Sitios
    
    $tam = 0;
    $tam = count($sitios);
    foreach ($usuarios as $valor ){
        
        for($i=0; $i < rand(1, 3); $i++){
            
            $aux1 = $sitios[rand(0, $tam-1)];
            $aux2 = $sitios[rand(0, $tam-1)];
            
            $objRel->crearRelacion($valor, $aux1, 'Fan'); 
            $objRel->crearRelacion($valor, $aux2, 'Desea'); 
            echo $valor."-usuarios  ---> Sitio-".$aux1." <br>";
            echo $valor."-usuarios  ---> Sitio-".$aux2." <br>";
            echo "-------------------------<br>";
        }
        
        
    }
    
    
    
//    usuarios 1 -> * Empresas
    
    $tam = 0;
    $tam = count($empresas);
    foreach ($usuarios as $valor ){
        
        for($i=0; $i < rand(1, 3); $i++){
            
            $aux = $empresas[rand(0, $tam-1)];
            $objRel->crearRelacion($valor, $aux, 'Cliente'); 
            echo $valor."-usuarios  ---> Empresas-".$aux." <br>";
        }
        
        
    }      
    
    
    
    
}




?>
