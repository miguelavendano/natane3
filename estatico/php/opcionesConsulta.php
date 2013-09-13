<?php
session_start();
require_once('../../core/coneccion.php');
require_once('../../core/modeloUsuario.php');
require_once('../../core/modeloSitio.php');
require_once('../../core/modeloEmpresa.php');
require_once('../../core/modeloExperiencia.php');
require_once('../../core/modeloImagen.php');
require_once('../../core/modeloRelaciones.php');
//require_once('../../modulos/consultas/consulta.php');


if(isset($_POST['opcion'])){
    
    $band="false";
    $opcion=$_POST['opcion'];
                                  
    switch ($opcion){
        
        // BUSQUEDA
        case "busqueda":                       
            
            $query="START n=node(*) WHERE n.nombre =~ '".$_POST['consulta'].".*' RETURN n";
            $modelusuarios = new ModelUsuarios();            
            $resultado = $modelusuarios->get_usuario($query);
                        
            $ban1 = array();
            for($i=0;$i<count($resultado);$i++){   
                //$respuesta = "id".$resultado[$i]->id."nombre".$resultado[$i]->nombre."apellido".$resultado[$i]->apellido;
                        
                $respuesta = array(
                    "id"=> $resultado[$i]->id,
                    "nombre"=> $resultado[$i]->nombre,
                    "apellido"=> $resultado[$i]->apellido,
                    "imagen"=> $resultado[$i]->imagen,                    
                );
                array_push($ban1,$respuesta);                                
            }               
            
            $ban2 = json_encode($ban1);
             
            $ban3 = array();
            $muestre ="";
            foreach(json_decode($ban2) as $obj){
                /*
                    echo $id= $obj->id;
                    echo $nombre = $obj->nombre;
                    echo $apellido = $obj->apellido;
                */
                //$nom_actual = $obj->id.'"'."=>".$obj->nombre." ".$obj->apellido;                
                $nom_actual = $obj->nombre." ".$obj->apellido;                
                $muestre = array($nom_actual);
                array_push($ban3, $nom_actual);
            }            
                        
            $band = json_encode($ban3);
            
        break;

        /*
         * Realiza la busqueda de todos los elementos segun la consulta ingresada 
         */                
        case "busca_todo":     
            
            $query="START n=node(*) WHERE n.nombre =~ '".$_POST['consulta'].".*' AND n.type='Sitio' RETURN n";

            $modelsitios = new ModelSitios();            
            $resultado = $modelsitios->get_sitio($query);         
                        
            $band = "";
            $cont=0;
            
            for($i=0;$i<count($resultado);$i++){   

                $contenido=
                '<div class="span3 contenido">
                    <div class="row-fluid titulo-result">
                        <a href="/natane3/modulos/sitios/sitio.php?id='.$resultado[$i]->id.'"><h5><i class="'.$resultado[$i]->tipo_sitio.'"></i>'.$resultado[$i]->nombre.'</h5></a>
                    </div>
                    <div class="row-fluid">
                        <div class="resultado">
                            <div class="imagen-resultado">
                                <img src="/natane3/estatico/imagenes/'.$resultado[$i]->imagen.'">
                            </div>
                        </div>
                    </div>
                </div>';            

                if($cont==0){
                    $html='<div class="container-fluid">'.$contenido;
                    $cont++;
                }
                elseif($cont==3){
                    $html=$contenido.'</div>';
                    $cont=0;
                }
                else{
                    $html=$contenido;
                    $cont++;
                }
                
                $band.=$html;
            }                       
  

            $query="START n=node(*) WHERE n.nombre =~ '".$_POST['consulta'].".*' AND n.type='Usuario' RETURN n";

            $modelusuarios = new ModelUsuarios();            
            $resultado = $modelusuarios->get_usuario($query);         
            
            
            for($i=0;$i<count($resultado);$i++){   

                $contenido=
                '<div class="span3 contenido">
                    <div class="row-fluid titulo-result">
                        <a href="/natane3/modulos/usuarios/usuario.php?id='.$resultado[$i]->id.'"><h5>'.$resultado[$i]->nombre." ".$resultado[$i]->apellido.'</h5></a>
                    </div>
                    <div class="row-fluid">
                        <div class="resultado">
                            <div class="imagen-resultado">
                                <img src="/natane3/estatico/imagenes/'.$resultado[$i]->imagen.'">
                            </div>
                        </div>
                    </div>
                </div>';            

                if($cont==0){
                    $html='<div class="container-fluid">'.$contenido;
                    $cont++;
                }
                elseif($cont==3){
                    $html=$contenido.'</div>';
                    $cont=0;
                }
                else{
                    $html=$contenido;
                    $cont++;
                }
                
                $band.=$html;
            }               

            
        break;            
    
        
        /*
         * Realiza la busqueda de los Usuarios segun la consulta ingresada 
         */        
        case "busca_usuario":     
            
            $query="START n=node(*) WHERE n.nombre =~ '".$_POST['consulta'].".*' AND n.type='Usuario' RETURN n";

            $modelusuarios = new ModelUsuarios();            
            $resultado = $modelusuarios->get_usuario($query);         
                        
            $band = "";
            $cont=0;
            
            for($i=0;$i<count($resultado);$i++){   

                $contenido=
                '<div class="span3 contenido">
                    <div class="row-fluid titulo-result">
                        <a href="/natane3/modulos/usuarios/usuario.php?id='.$resultado[$i]->id.'"><h5>'.$resultado[$i]->nombre." ".$resultado[$i]->apellido.'</h5></a>
                    </div>
                    <div class="row-fluid">
                        <div class="resultado">
                            <div class="imagen-resultado">
                                <img src="/natane3/estatico/imagenes/'.$resultado[$i]->imagen.'">
                            </div>
                        </div>
                    </div>
                </div>';            

                if($cont==0){
                    $html='<div class="container-fluid">'.$contenido;
                    $cont++;
                }
                elseif($cont==3){
                    $html=$contenido.'</div>';
                    $cont=0;
                }
                else{
                    $html=$contenido;
                    $cont++;
                }
                
                $band.=$html;
            }               
  
        break;    

        
        /*
         * Realiza la busqueda de los Sitios segun la consulta ingresada 
         */                
        case "busca_sitio":     
            
            $query="START n=node(*) WHERE n.nombre =~ '".$_POST['consulta'].".*' AND n.type='Sitio' RETURN n";

            $modelsitios = new ModelSitios();            
            $resultado = $modelsitios->get_sitio($query);         
                        
            $band = "";
            $cont=0;
            
            for($i=0;$i<count($resultado);$i++){   

                $contenido=
                '<div class="span3 contenido">
                    <div class="row-fluid titulo-result">
                        <a href="/natane3/modulos/sitios/sitio.php?id='.$resultado[$i]->id.'"><h5><i class="'.$resultado[$i]->tipo_sitio.'"></i> '.$resultado[$i]->nombre.'</h5></a>
                    </div>
                    <div class="row-fluid">
                        <div class="resultado">
                            <div class="imagen-resultado">
                                <img src="/natane3/estatico/imagenes/'.$resultado[$i]->imagen.'">
                            </div>
                        </div>
                    </div>
                </div>';            

                if($cont==0){
                    $html='<div class="container-fluid">'.$contenido;
                    $cont++;
                }
                elseif($cont==3){
                    $html=$contenido.'</div>';
                    $cont=0;
                }
                else{
                    $html=$contenido;
                    $cont++;
                }
                
                $band.=$html;
            }               
  
        break;            
    
        default : break; 
    }    
    
    echo $band;
}

?>