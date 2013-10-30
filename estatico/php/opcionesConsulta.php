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
        
        /*
         * Realiza la busqueda de todos los elementos segun la consulta ingresada 
         */                
        case "busca_todo":     
            
            /*BUSCA LOS SITIOS*/            
            $query = "START n=node(*) WHERE n.nombre =~ '(?i).*".$_POST['consulta'].".*' AND n.type<>'Imagen' AND n.type<>'Experiencia' AND n.type<>'Servicio' RETURN n";
            //$query="START n=node(*) WHERE n.nombre =~ '(?i)".$_POST['consulta'].".*' AND n.type='Sitio' RETURN n";
            //expreciones regulares utiles
            //  n.nombre =~ 'ju.*'          -->  busca los nodos que empiezan exactamente con "ju"
            //  n.nombre =~ '(?i)JULI:*'    -->  busca los nodos que empiezan con "ju" sin importar mayusculas o minusculas
            //  n.nombre =~ '(?i).*JULI.*'  -->  busca los nodos que contengan la cadena "ju" sin importar mayusculas o minusculas
            
            $modelsitios = new ModelSitios();            
            $resultado = $modelsitios->get_todo($query);

            $no_hay=0;

            $band="";
            $cont=0;                        
            $html="";
            
            if($resultado){            
                
                for($i=0;$i<count($resultado);$i++){   

                    if($resultado[$i]->type=="Sitio"){  /*BUSCA LOS SITIOS*/
                        $contenido=
                       '<div class="span3 contenido">
                           <div class="row-fluid imagen-resultado">
                               <img src="/natane3/estatico/imagenes/'.$resultado[$i]->imagen.'">
                               <div class="row-fluid titulo-result">
                                   <a href="/natane3/modulos/sitios/sitio.php?id='.$resultado[$i]->id.'"><h6><i class="'.$resultado[$i]->tipo_sitio.'"></i> '.$resultado[$i]->nombre.'</h6></a>
                               </div>        
                           </div>    
                       </div>';                                                                        
                    }
                    elseif($resultado[$i]->type=="Empresa"){  /*BUSCA LAS EMPRESAS*/            
                        $contenido=
                        '<div class="span3 contenido">
                            <div class="row-fluid imagen-resultado">
                                <img src="/natane3/estatico/imagenes/'.$resultado[$i]->imagen.'">
                                <div class="row-fluid titulo-result">
                                    <a href="/natane3/modulos/empresas/empresa.php?id='.$resultado[$i]->id.'"><h6>'.$resultado[$i]->nombre.'</h6></a>
                                </div>        
                            </div>    
                        </div>';                        
                    }
                    elseif($resultado[$i]->type=="Usuario"){    /*BUSCA LOS USUARIOS*/
                        $contenido=
                        '<div class="span3 contenido">
                            <div class="row-fluid imagen-resultado">
                                <img src="/natane3/estatico/imagenes/'.$resultado[$i]->imagen.'">
                                <div class="row-fluid titulo-result">
                                    <a href="/natane3/modulos/usuarios/usuario.php?id='.$resultado[$i]->id.'"><h6>'.$resultado[$i]->nombre." ".$resultado[$i]->apellido.'</h6></a>
                                </div>        
                            </div>    
                        </div>';
                    }

                    
                    //organiza los resultados en los containers
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
            }
            else{ $band = "<h2>NO se han encontrado coincidencias.</h2>"; }
            
        break;            
    
        
        /*
         * Realiza la busqueda de los Usuarios segun la consulta ingresada 
         */        
        case "busca_usuario":     
            
            $query="START n=node(*) WHERE n.nombre =~ '(?i).*".$_POST['consulta'].".*' AND n.type='Usuario' RETURN n";

            $modelusuarios = new ModelUsuarios();            
            $resultado = $modelusuarios->get_usuario($query);         
                        
            if($resultado){            
            
                $band = "";
                $cont=0;

                for($i=0;$i<count($resultado);$i++){   

                    $contenido=
                    '<div class="span3 contenido">
                        <div class="row-fluid imagen-resultado">
                            <img src="/natane3/estatico/imagenes/'.$resultado[$i]->imagen.'">
                            <div class="row-fluid titulo-result">
                                <a href="/natane3/modulos/usuarios/usuario.php?id='.$resultado[$i]->id.'"><h6>'.$resultado[$i]->nombre." ".$resultado[$i]->apellido.'</h6></a>
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
                    
                }//cierre for            
            }//cierre if
            else{ $band = "<h2>NO se han encontrado coincidencias.</h2>"; }            
  
        break;    

        
        /*
         * Realiza la busqueda de los Sitios segun la consulta ingresada 
         */                
        case "busca_sitio":     
            
            $filtro = $_POST['filtro'];

            if( strlen($filtro) > 0 ){
                $query="START n=node(*) WHERE n.nombre =~ '(?i).*".$_POST['consulta'].".*' AND n.type='Sitio' AND n.tipo_sitio='".$filtro."' RETURN n";
            }else{
                $query="START n=node(*) WHERE n.nombre =~ '(?i).*".$_POST['consulta'].".*' AND n.type='Sitio' RETURN n";
            }

            $modelsitios = new ModelSitios();            
            $resultado = $modelsitios->get_sitio($query);         

            if($resultado){            

                $band = "";
                $cont=0;

                for($i=0;$i<count($resultado);$i++){   

                    $contenido=
                    '<div class="span3 contenido">
                        <div class="row-fluid imagen-resultado">
                            <img src="/natane3/estatico/imagenes/'.$resultado[$i]->imagen.'">
                            <div class="row-fluid titulo-result">
                                <a href="/natane3/modulos/sitios/sitio.php?id='.$resultado[$i]->id.'"><h6><i class="'.$resultado[$i]->tipo_sitio.'"></i> '.$resultado[$i]->nombre.'</h6></a>
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
                      
                }//cierre for            
            }//cierre if
            else{ $band = "<h2>NO se han encontrado coincidencias.</h2>"; }            
  
  
        break;            
    
/*
         * Realiza la busqueda de los Sitios segun la consulta ingresada 
         */                
        case "busca_empresa":     
            
            $query="START n=node(*) WHERE n.nombre =~ '(?i).*".$_POST['consulta'].".*' AND n.type='Empresa' RETURN n";

            $modelempresa = new ModelEmpresa();            
            $resultado = $modelempresa->get_empresa($query);         

            if($resultado){            
            
                $band = "";
                $cont=0;

                for($i=0;$i<count($resultado);$i++){   

                    $contenido=
                    '<div class="span3 contenido">
                        <div class="row-fluid imagen-resultado">
                            <img src="/natane3/estatico/imagenes/'.$resultado[$i]->imagen.'">
                            <div class="row-fluid titulo-result">
                                <a href="/natane3/modulos/empresas/empresa.php?id='.$resultado[$i]->id.'"><h6>'.$resultado[$i]->nombre.'</h6></a>
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
                      
                }//cierre for            
            }//cierre if
            else{ $band = "<h2>NO se han encontrado coincidencias.</h2>"; }            
  
        break;            
        
        default : break; 
    }    
    
    echo $band;
}

?>