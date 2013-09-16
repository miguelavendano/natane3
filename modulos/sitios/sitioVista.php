<?php

    require_once '../../core/global_var.php';

    class SitioVista{
        
        public $base;
        public $head;
        public $modal;
        public $links;
        public $metas;
        private $dic_base;

        public $id_sitio;
        public $nombre;
        public $sitio;        
        public $slider_sitio;        
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
        public $registrar;
        public $latitud;
        public $longitud;
        
        public $dic_general;
        public $dic_contenido;


        

        
        public function __construct($id) {

            $this->id_sitio = $id;
            $this->img_slider_act = '<div class="item active">
                                        <img alt="Jaipur" src="{IMG_NATANE}/{url}" />
                                    </div>';
            $this->img_slider = '<div class="item">
                                    <img alt="Jaipur" src="{IMG_NATANE}/{url}" />
                                </div>';            

        
            $this->base = file_get_contents('../../plantillas/generales/base.html');
            $this->head = file_get_contents('../../plantillas/generales/headSitio.html');
            $this->modal = file_get_contents('../../plantillas/generales/barraModal.html');                                    
            
            $this->sitio = file_get_contents('../../plantillas/sitios/perfilSitio.html');   
            $this->slider_sitio = file_get_contents('../../plantillas/sitios/slider_sitio.html');      
            $this->contacto = file_get_contents('../../plantillas/sitios/contacto.html'); 
            $this->seguidores = file_get_contents('../../plantillas/generales/seguidores.html');
            $this->gustaria = $this->seguidores;
            $this->ferrocarril = file_get_contents('../../plantillas/generales/ferrocarril.html');
            $this->elemento_ferro = file_get_contents('../../plantillas/generales/elemento_ferro.html');
            $this->editar = file_get_contents('../../plantillas/sitios/editarSitio.html');
            $this->registrar = file_get_contents('../../plantillas/sitios/registrarSitio.html');
            $this->modales = file_get_contents('../../plantillas/generales/barraModal.html');
                     
            $this->metas = '<meta charset="utf-8">
                            <title>{TITULO}</title>
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">                            
                            <meta name="description" content="">
                            <meta name="author" content="">
                            <meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> <!-- google maps -->';
            
            $this->links = '<link href="{CSS}/bootstrap.css" rel="stylesheet">
                            <link href="{CSS}/bootstrap-responsive.css" rel="stylesheet">
                            <link href="{CSS}/estilos.css" rel="stylesheet">
                            <link href="{CSS}/estilos_perfil_sitio.css" rel="stylesheet">    
                            <link href="{CSS}/estilos_ferrocarril.css" rel="stylesheet">
                            <link href="{CSS}/estilos_modal.css" rel="stylesheet" />
                            <link href="{CSS}/font-awesome.min.css" rel="stylesheet" />';
    
            
            $this->script = "";
            
            
            $this->dic_general = array('metas' => $this->metas,
                                    'links' => $this->links ,
                                    'script' => $this->script,
                                    'head' => $this->head ,
                                    'contenido' => $this->sitio);

            
            $this->dic_contenido = array('slider_sitio' => $this->slider_sitio, 
                                        'nombre'=>$this->nombre,
                                        'descripcion' => $this->descripcion, 
                                        'contacto' => $this->contacto, 
                                        'seguidores' => $this->seguidores, 
                                        'gustaria' => $this->gustaria, 
                                        'ferrocarril' => $this->ferrocarril,
                                        'editarSitio'=>$this->editar,
                                        'registrarSitio'=>$this->registrar,
                                        'latitud'=>$this->latitud,                
                                        'longitud'=>$this->longitud,                                
                                        'modales' => $this->modal,                                        
                                        'id_sitio'=>$this->id_sitio);
        }
        
        
        public function actualizar_diccionarios(){
            
            $this->dic_general = array('metas' => $this->metas,
                                    'links' => $this->links ,
                                    'script' => $this->script,
                                    'head' => $this->head ,
                                    'contenido' => $this->sitio);
            
            $this->dic_contenido = array('slider_sitio' => $this->slider_sitio, 
                                        'nombre'=>$this->nombre,
                                        'descripcion' => $this->descripcion, 
                                        'contacto' => $this->contacto, 
                                        'seguidores' => $this->seguidores, 
                                        'gustaria' => $this->gustaria, 
                                        'ferrocarril' => $this->ferrocarril,
                                        'editarSitio' => $this->editar,
                                        'registrarSitio'=>$this->registrar,                
                                        'latitud'=>$this->latitud,                
                                        'longitud'=>$this->longitud,                
                                        'modales' => $this->modal,                                        
                                        'id_sitio'=>$this->id_sitio);            
            
        }
        
        public function refactory_slider($datos){   // contruye el slider
            
            $imagenes = str_ireplace("{url}", $datos[0], $this->img_slider_act); // carga la imagen principal del slider

            for($i=1; $i<count($datos); $i++){  // carga el resto de imagenes                             
                $imagenes .= str_ireplace("{url}", $datos[$i], $this->img_slider);
            }            
                        
            $this->slider_sitio = str_ireplace("{imagenes}", $imagenes, $this->slider_sitio);   // se remplazan todas las imagenes sobre el template de slider
            
            $this->actualizar_diccionarios();

        }        
        
        
        
        public function refactory_contacto($datos){                
            
            $this->nombre = $datos[0]->nombre;
            $this->contacto = str_ireplace('{tel}', $datos[0]->telefono, $this->contacto );
            $this->contacto = str_ireplace('{dir}', $datos[0]->direccion, $this->contacto );
            $this->contacto = str_ireplace('{correo}', $datos[0]->correo, $this->contacto );
            $this->contacto = str_ireplace('{facebook}', $datos[0]->facebook, $this->contacto );
            $this->contacto = str_ireplace('{twitter}', $datos[0]->twitter, $this->contacto );
            $this->contacto = str_ireplace('{google}', $datos[0]->youtube, $this->contacto );        
            $this->descripcion = $datos[0]->descripcion;

            $this->actualizar_diccionarios();
        }
        
        
        public function refactory_visitantes($datos){
            
            $complete = "";
            $empresa = '';
            $global = new Global_var();
            $url = $global->url_usuario;            
            foreach ($datos as $valor){
                $aux = $this->seguidores;        
                $aux = str_ireplace('{url}', $url, $aux);
                $aux = str_ireplace('{empresa}', $empresa, $aux);            
                $aux = str_ireplace('{id}', $valor->id, $aux);            
                $aux = str_ireplace('{imagen}', $valor->imagen, $aux);            
                $aux = str_ireplace('{nombre}', $valor->nick, $aux);            
                $complete .= $aux;
                
            }
            
            $this->seguidores = $complete;
            $this->actualizar_diccionarios();
        }
        

        public function refactory_gustaria($datos){            
            
            $quiere = "";
            $global = new Global_var();
            $url = $global->url_usuario;
            foreach ($datos as $valor){
                $aux = $this->gustaria;
                $aux = str_ireplace('{url}', $url, $aux);            
                $aux = str_ireplace('{id}', $valor->id, $aux);            
                $aux = str_ireplace('{imagen}', $valor->imagen, $aux);            
                $aux = str_ireplace('{nombre}', $valor->nick, $aux);  
                $quiere .= $aux;
            }
            
            $this->gustaria = $quiere;            
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
            
        }            
     

        public function refactory_mapa( $coordenadas ){            
            $this->latitud = $coordenadas[0]->latitud;
            $this->longitud = $coordenadas[0]->longitud;                      
            $this->actualizar_diccionarios();
        }        
        
        
        public function refactory_contenido(){            
            
            foreach($this->dic_contenido as $clave=>$valor){
               
                $this->sitio = str_ireplace('{'.$clave.'}', $valor, $this->sitio);
                
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



<?php

    $file = '../plantillas/perfilSitio.html';
    $head = file_get_contents('../plantillas/componentes/head.html');
    $slider = file_get_contents('../plantillas/componentes/slider.html');    
    $sigue = file_get_contents('../plantillas/componentes/seguidores.html');
    $modal = file_get_contents('../plantillas/componentes/barraModal.html');    
    
    $diccionario = array('head'=>$head,
                        'slider'=>$slider,  
                        'seguidores'=>$sigue,        
                        'modales'=>$modal);    
    
    $template = file_get_contents($file);
    
    foreach ($diccionario as $clave=>$valor){
        $template = str_ireplace('{'.$clave.'}', $valor, $template);
    }
    
    
    print $template;

?>