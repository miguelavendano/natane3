<?php

    require_once '../../core/global_var.php';

    class EmpresaVista{
        
        public $base;
        public $head;
        public $modal;
        public $links;
        public $metas;

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
            $this->head = file_get_contents('../../plantillas/generales/head.html');
            $this->modal = file_get_contents('../../plantillas/generales/barraModal.html');                                    
            
            $this->empresa= file_get_contents('../../plantillas/empresas/perfilEmpresa.html');   
            $this->slider_empresa= file_get_contents('../../plantillas/empresas/slider_empresas.html');      
            $this->servicios = file_get_contents('../../plantillas/empresas/servicios.html');      
            $this->expe = file_get_contents('../../plantillas/usuario/experiencia.html');      
            $this->contacto = file_get_contents('../../plantillas/sitios/contacto.html'); 
            $this->seguidores = file_get_contents('../../plantillas/generales/seguidores.html');
            $this->gustaria= $this->seguidores;
            $this->ferrocarril= file_get_contents('../../plantillas/generales/ferrocarril.html');
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

            
            
            
            $this->dic_general = array('metas' => $this->metas,
                                    'links' => $this->links ,
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
                                        'experiencias'=> $this->expe);
            
            
        }
        
        
        public function actualizar_diccionarios(){
            
            $this->dic_general = array('metas' => $this->metas,
                                    'links' => $this->links ,
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
                                        'experiencias'=> $this->expe);
            
            
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
            
            $this->contacto = str_ireplace('{tel}',$datos[0]->name ,$this->contacto );
            $this->contacto = str_ireplace('{dir}',$datos[0]->name ,$this->contacto );
            $this->contacto = str_ireplace('{correo}',$datos[0]->name ,$this->contacto );
            $this->contacto = str_ireplace('{facebook}',$datos[0]->name ,$this->contacto );
            $this->contacto = str_ireplace('{twitter}',$datos[0]->name ,$this->contacto );
            $this->contacto = str_ireplace('{google}',$datos[0]->name ,$this->contacto );         
            
            $this->descripcion = "un empresa excelente para  todo !! ";

            $this->actualizar_diccionarios();
            


        }
        
        public function refactory_seguidores($datos){
            
            $complete = "";
            for ($i=0; $i<5 ; $i++){
                $aux = $this->seguidores;
                $aux = str_ireplace('{imagen}', $datos[$i]->img, $aux);            
                $aux = str_ireplace('{nombre}', $datos[$i]->name, $aux);            
                $complete .= $aux;
            }
            
            $this->seguidores = $complete;
            $this->actualizar_diccionarios();
        }
                      
        

        public function refactory_gustaria($datos){            
            
            $quiere = "";
            
            for ($i=0; $i<5 ; $i++){
                $aux = $this->gustaria;
                $aux = str_ireplace('{imagen}', $datos[$i]->img, $aux);            
                $aux = str_ireplace('{nombre}', $datos[$i]->name, $aux);                            
                $quiere .= $aux;
            }
            
            $this->gustaria = $quiere;            
            $this->actualizar_diccionarios();
            
            
        }        
        
        public function refactory_ferrocarril(array $datos){  // contruye el ferrocarril
            
            $elementos="";     // variable que construirá los elementos de ferrocarril
            $aux="";                        
            
            
            for ($i=0; $i<count($datos); $i++){   // construye los elementos del ferrocarril
                
                $aux = $this->elemento_ferro;                  
                $aux = str_ireplace("{icono}", $datos[$i]->tipo, $aux);                
                $aux = str_ireplace("{nombre}", $datos[$i]->name, $aux);                
                $aux = str_ireplace("{imagen}", $datos[$i]->img, $aux);                                              
                
                $elementos = $elementos.$aux;  
                
                
                
            }
            
            // termina de ensamblar los elementos del ferrocarril con la estructura general del mismo            
            $this->ferrocarril = str_ireplace("{contenido_ferro}", $elementos, $this->ferrocarril);
            
            $this->actualizar_diccionarios();// actualiza los valores del diccionarios de datos
            
        }            

        public function refactory_servicios($datos){            
            
            $resultados="";
            $elemento = $this->servicios;
            
            
            for($c=0; count($datos); $c++){                
                
                $resultados .= '<div class="row-fluid">';                            
                $i=0;
                do{ 
                    $empresa=array_shift($datos);
                    $aux = $elemento;
                    $aux = str_ireplace("{nombre}", $empresa->name, $aux);
                    $aux = str_ireplace("{imagen}", $empresa->img, $aux);                
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
                $aux = str_ireplace('{imagen}', $valor->img, $aux);
                $aux = str_ireplace('{dirigido_a}', $valor->name, $aux);
                $aux = str_ireplace('{comentario}', "un muy buen lugar para pasear con la familia", $aux);
                
                $experiencias .= $aux;
            }
            
            $this->expe = $experiencias;
            
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