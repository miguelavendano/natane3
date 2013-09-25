<?php

    require_once '../../core/global_var.php';

    class EmpresaVista{
        
        public $base;
        public $head;
        public $modal;
        public $links;
        public $metas;
        public $nombre;
        
        public $empresa; 
        public $servicios;
        public $expe;
        public $slider_empresa;        
        public $contacto;
        public $seguidores;
        public $gustaria;
        public $ferrocarril;        
        public $elemento_ferro;
        public $modales;       
        public $img_slider_act;
        public $img_slider;
        public $descripcion;
        public $editar;
        public $latitud;
        public $longitud;   
        public $confianza;


        public $script;        
        
        public $dic_general;
        public $dic_contenido;


        

        
        public function __construct() {

            $this->img_slider_act = '<div class="item active">
                                        <img alt="Jaipur" src="{IMG_NATANE}/{url}" />
                                    </div>';
            $this->img_slider = '<div class="item">
                                    <img alt="Jaipur" src="{IMG_NATANE}/{url}" />
                                </div>';            
                  
        
            $this->base = file_get_contents('../../plantillas/generales/base.html');
            $this->head = file_get_contents('../../plantillas/generales/headEmpresa.html');
            $this->modal = file_get_contents('../../plantillas/generales/barraModal.html');                                    
            
            $this->empresa= file_get_contents('../../plantillas/empresas/perfilEmpresa.html');   
            $this->slider_empresa= file_get_contents('../../plantillas/empresas/slider_empresas.html');      
            $this->servicios = file_get_contents('../../plantillas/empresas/servicios.html');      
            $this->expe = file_get_contents('../../plantillas/usuario/experiencia.html');      
            $this->contacto = file_get_contents('../../plantillas/sitios/contacto.html'); 
            $this->seguidores = file_get_contents('../../plantillas/generales/seguidores.html');
            $this->gustaria= $this->seguidores;
            $this->ferrocarril= file_get_contents('../../plantillas/generales/ferrocarril.html');
            $this->editar = file_get_contents('../../plantillas/empresas/editarEmpresa.html');
            $this->elemento_ferro= file_get_contents('../../plantillas/generales/elemento_ferro.html');
            $this->modales= file_get_contents('../../plantillas/generales/barraModal.html');
                     
            $this->metas = '<meta charset="utf-8">
                            <title> {TITULO} </title>    
                            <meta name="description" content="">
                            <meta name="author" content="">
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <!--<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />-->';
            
            $this->links = '<link href="{CSS}/bootstrap.css" rel="stylesheet">
                            <link href="{CSS}/bootstrap-responsive.css" rel="stylesheet">    
                            <link href="{CSS}/estilos.css" rel="stylesheet">    
                            <link href="{CSS}/estilos_perfil_empresa.css" rel="stylesheet"> 
                            <link href="{CSS}/estilos_ferrocarril.css" rel="stylesheet">    
                            <link href="{CSS}/estilos_resultado_busqueda.css" rel="stylesheet">    
                            <link href="{CSS}/estilos_modal.css" rel="stylesheet" />
                            <link href="{CSS}/font-awesome.min.css" rel="stylesheet" />    ';

            

            $this->script = "";            
            
            
            
            $this->dic_general = array('metas' => $this->metas,
                                    'links' => $this->links ,
                                    'script' => $this->script,
                                    'head' => $this->head ,
                                    'contenido' => $this->empresa);
            
            
            $this->dic_contenido = array('slider_empresa' => $this->slider_empresa, 
                                        'descripcion' => $this->descripcion, 
                                        'contacto' => $this->contacto, 
                                        'seguidores' => $this->seguidores, 
                                        'gustaria' => $this->gustaria, 
                                        'ferrocarril' => $this->ferrocarril,
                                        'modales' => $this->modal,
                                        'servicios' => $this->servicios,
                                        'experiencias'=> $this->expe,
                                        'nombre_empresa'=>$this->nombre,
                                        'editarEmpresa' => $this->editar,
                                        'latitud'=>$this->latitud,                
                                        'longitud'=>$this->longitud,
                                        'confianza'=>$this->confianza);
            
        }
        
        
        public function actualizar_diccionarios(){
            
            $this->dic_general = array('metas' => $this->metas,
                                    'links' => $this->links ,
                                    'script' => $this->script,
                                    'head' => $this->head ,
                                    'contenido' => $this->empresa);
            
            $this->dic_contenido = array('slider_empresa' => $this->slider_empresa, 
                                        'descripcion' => $this->descripcion, 
                                        'contacto' => $this->contacto, 
                                        'seguidores' => $this->seguidores, 
                                        'gustaria' => $this->gustaria, 
                                        'ferrocarril' => $this->ferrocarril,
                                        'modales' => $this->modal,
                                        'servicios' => $this->servicios,
                                        'experiencias'=> $this->expe,
                                        'nombre_empresa'=>$this->nombre,
                                        'editarEmpresa' => $this->editar,
                                        'latitud'=>$this->latitud,                
                                        'longitud'=>$this->longitud,
                                        'confianza'=>$this->confianza);
            
            
        }
        
        public function refactory_slider($datos){   // contruye el slider
            
            $imagenes = str_ireplace("{url}", $datos[0], $this->img_slider_act); // carga la imagen principal del slider

            for($i=1; $i<count($datos); $i++){  // carga el resto de imagenes                             
                $imagenes .= str_ireplace("{url}", $datos[$i], $this->img_slider);
            }            
                        
            $this->slider_empresa = str_ireplace("{imagenes}", $imagenes, $this->slider_empresa);   // se remplazan todas las imagenes sobre el template de slider
            
            $this->actualizar_diccionarios();

        }        
        
        
        
        public function refactory_contacto($datos){                

            $this->nombre = $datos[0]->nombre;
            
            $this->descripcion = $datos[0]->descripcion;
            
            $this->contacto = str_ireplace('{tel}',$datos[0]->telefono ,$this->contacto );
            $this->contacto = str_ireplace('{dir}',$datos[0]->direccion ,$this->contacto );
            $this->contacto = str_ireplace('{correo}',$datos[0]->correo ,$this->contacto );
            $this->contacto = str_ireplace('{facebook}',$datos[0]->facebook ,$this->contacto );
            $this->contacto = str_ireplace('{twitter}',$datos[0]->twitter ,$this->contacto );
            $this->contacto = str_ireplace('{google}',$datos[0]->youtube ,$this->contacto );         
            
            $this->confianza = $datos[0]->confianza;           

            $this->actualizar_diccionarios();
            


        }
        
        public function refactory_amigos($datos){
            
            ///_------------
            $complete = "";
            $global = new Global_var();
            $url = $global->url_usuario;
            foreach ($datos as $valor){
                $aux = $this->seguidores;
                $aux = str_ireplace('{url}', $url, $aux);            
                $aux = str_ireplace('{id}', $valor->id, $aux);            
                $aux = str_ireplace('{imagen}', $valor->imagen, $aux);            
                $aux = str_ireplace('{nombre}', $valor->nick, $aux);  
                $complete.= $aux;
            }
            
            $this->seguidores = $complete;
            $this->actualizar_diccionarios();
            

        }
                      
        

        public function refactory_clientes_aliados($datos){            
            
            $complete = "";
            
            
            foreach ($datos as $valor){
                $global = new Global_var();
                $empresa = '';
                $nombre = '';
                $url = '';
                $aux = $this->gustaria;
                //echo $valor->type;
                if($valor->type == "Empresa"){                                    	         
                    $empresa = 'style="background-color: #CBFEC1"';
                    $nombre = $valor->nombre;
                    $url = $global->url_empresa;
                }else{
                    $nombre = $valor->nick;
                    $url = $global->url_usuario;
                }            
                $aux = str_ireplace('{empresa}', $empresa, $aux);            
                $aux = str_ireplace('{id}', $valor->id, $aux);
                $aux = str_ireplace('{url}', $url, $aux);
                $aux = str_ireplace('{imagen}', $valor->imagen, $aux);
                $aux = str_ireplace('{nombre}', $nombre, $aux);
                $complete .= $aux;
            }
            
            $this->gustaria = $complete;
            $this->actualizar_diccionarios();

        }        
        
        public function refactory_ferrocarril(array $datos){  // contruye el ferrocarril

            
            $elementos="";     // variable que construirá los elementos de ferrocarril
            $aux="";                        
            
            
            foreach ($datos as $valor){   // construye los elementos del ferrocarril
                
                $aux = $this->elemento_ferro;                  
                $aux = str_ireplace("{id_sitio}", $valor->id, $aux);
                $aux = str_ireplace("{icono}", $valor->tipo_sitio, $aux);                
                $aux = str_ireplace("{nombre}", $valor->nombre, $aux);                
                $aux = str_ireplace("{imagen}", $valor->imagen, $aux);                                              
                
                $elementos = $elementos.$aux;  
                
                
                
            }
            
            // termina de ensamblar los elementos del ferrocarril con la estructura general del mismo            
            $this->ferrocarril = str_ireplace("{contenido_ferro}", $elementos, $this->ferrocarril);
            
            $this->actualizar_diccionarios();// actualiza los valores del diccionarios de datos            
            
            
            
            
            
            
            
//            $elementos="";     // variable que construirá los elementos de ferrocarril
//            $aux="";                        
//            
//            
//            for ($i=0; $i<count($datos); $i++){   // construye los elementos del ferrocarril
//                
//                $aux = $this->elemento_ferro;                  
//                $aux = str_ireplace("{icono}", $datos[$i]->tipo, $aux);                
//                $aux = str_ireplace("{nombre}", $datos[$i]->name, $aux);                
//                $aux = str_ireplace("{imagen}", $datos[$i]->img, $aux);                                              
//                
//                $elementos = $elementos.$aux;  
//                
//                
//                
//            }
//            
//            // termina de ensamblar los elementos del ferrocarril con la estructura general del mismo            
//            $this->ferrocarril = str_ireplace("{contenido_ferro}", $elementos, $this->ferrocarril);
//            
//            $this->actualizar_diccionarios();// actualiza los valores del diccionarios de datos
            
        }            

        public function refactory_servicios($datos){            
            
            $resultados="";
            $elemento = $this->servicios;
            
            
            for($c=0; count($datos); $c++){                
                
                $resultados .= '<div class="row-fluid">';                            
                $i=0;
                do{ 
                    $servicio=array_shift($datos);
                    $aux = $elemento;
                    $aux = str_ireplace("{nombre}", $servicio->type, $aux);
                    $aux = str_ireplace("{imagen}", "rafting-rio-savegre.jpg", $aux);                
                    $resultados .= $aux;
                    $i++;
                }while((count($datos)!=0)&& $i<3);
                
                
                $resultados .= '</div>';
            }
            
            
            $this->servicios = $resultados;
            $this->actualizar_diccionarios();
            
            
        }               
        public function refactory_experiencias($datos){            
            
            $experiencias = "";
            
            foreach ($datos as $valor){
                $aux = $this->expe;
                $aux = str_ireplace('{imagen}', $valor->imagen, $aux);
                $aux = str_ireplace('{dirigido_a}', $valor->nombre, $aux);
                $aux = str_ireplace('{comentario}',$valor->descripcion , $aux);
                
                $experiencias .= $aux;
            }
            
            $this->expe = $experiencias;            
            $this->actualizar_diccionarios();
                        
        }        
            

        public function refactory_mapa( $coordenadas ){            
            $this->latitud = $coordenadas[0]->latitud;
            $this->longitud = $coordenadas[0]->longitud;                      
            $this->actualizar_diccionarios();
        }        
                
             
        
        public function refactory_contenido(){            
            
            foreach($this->dic_contenido as $clave=>$valor){               
                $this->empresa = str_ireplace('{'.$clave.'}', $valor, $this->empresa);                
            }           
            $this->actualizar_diccionarios();
                        
        }        
        
        public function refactory_total(){
            
            
            $globales = new Global_var();         
            
            foreach ($this->dic_general as $clave=>$valor){
                    
                $this->base = str_ireplace('{'.$clave.'}', $valor, $this->base);
                
            }
            
            foreach ($globales->global_var as $clave => $valor){
                $this->base = str_ireplace('{'.$clave.'}', $valor, $this->base);
            }            
            
            
            echo $this->base;
            
            
            
        }
        

    }
        
?>