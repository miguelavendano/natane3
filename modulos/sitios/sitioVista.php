<?php

    require_once '../../core/global_var.php';

    
    /**
     * Clase controlador de los elementos html5 utilizados en el modulo Empresa.
     * 
     */  
    class SitioVista{
        
        /**
         *Variable que contiene el codigo html de la estructura
         * general del la interfaz grafica. (plantillas/generales/base.html)
         * @var String  
         */                
        public $base;
        
        /**
         *Variable que contiene el codigo html del header de esta interfaz. (plantillas/generales/head.html)
         * @var String  
         */         
        public $head;
        /**
         *Variable que contiene el codigo html de la ventanas modales disponibles para esta interfaz. plantillas/generales/barraModal.html
         * @var String  
         */        
        public $modal;
        /**
         *Variable que contiene el codigo html de los " meta links" que serán utlizados.
         * @var String  
         */                  
        public $links;
        
        /**
         *Variable que contiene el codigo html de las etiquetas "meta" utilizadas para esta interfaz
         * @var String  
         */             
        public $metas;
        
        /**
         *Variable que contiene el codigo html de las etiquetas "script" utilizadas para esta interfaz
         * @var String  
         */    
        public $script;         
        
        /**
         *Variable diccionario general de las variables que poseen fracmentos html que generan el contenido de la interfaz grafica del Sitio.
         * @var String  
         */                   
        private $dic_base;

        /**
         *Variable que contiene el id del sitio a mostrar.
         * @var String 
         */        
        public $id_sitio;
        
        /**
         *Variable que contiene en nombre del sitio.
         * @var String 
         */        
        public $nombre;
        
        /**
         *Variable la estructura html5 de la estructura del perfil del sitio. (plantillas/sitios/perfilSitio.html).
         * @var String 
         */        
        public $sitio;        
        
        /**
         *Variable la estructura html5 del slider principal del Sitio. (plantillas/sitios/slider_sitio.html).
         * @var String 
         */        
        public $slider_sitio;        
        /**
         *Variable la estructura html5 del formulario para editar el slider principal del Sitio. (plantillas/generales/editar_slider.html).
         * @var String 
         */                    
        public $edita_slider;
        
        /**
         *Variable la estructura html5 de la estructura de los datos de contacto. (plantillas/sitios/contacto.html).
         * @var String 
         */          
        public $contacto;
        
        /**
         *Variable la estructura html5 de la sección de seguidores. (/plantillas/generales/seguidores.html).
         * @var String 
         */         
        public $seguidores;
        
        /**
         *Variable la estructura html5 de la sección de personas. (/plantillas/generales/seguidores.html).
         * @var String
         */        
        public $gustaria;
        
        /**
         *Variable la estructura html5 del ferrocarril de sitios relacionados. (plantillas/generales/ferrocarril.html).
         * @var String 
         */          
        public $ferrocarril;
        
        /**
         *Variable la estructura html5 de los elementos del ferrocarril de sitios relacionados. (plantillas/generales/elemento_ferro.html).
         * @var String 
         */          
        public $elemento_ferro;        
        
        /**
         *Variable que contiene el codigo html de la ventanas modales disponibles para esta interfaz. (plantillas/generales/barraModal.html)
         * @var String  
         */                     
        public $modales;       

        /**
         *Variable que contiene el codigo html de la imagen activa que se encuentra en el Slider.
         * @var String  
         */                            
        public $img_slider_act;

        /**
         *Variable que contiene el codigo html de la imagenes que se encuentran en el Slider.
         * @var String  
         */                                    
        public $img_slider;

        /**
         *Descripcion de la empresa.
         * @var String 
         */
        public $descripcion;
        
        /**
         *Variable que contiene el codigo html para mostrar el formulario de edición de datos. (plantillas/empresas/editarEmpresa.html)
         * @var String  
         */            
        public $editar;
        
        /**
         *Variable que contiene el codigo html para mostrar el formulario de registro de nuevo sitio. (plantillas/sitios/registrarSitio.html)
         * @var String  
         */            
        public $registrar;
        /**
         *Coordenada latitud de la ubicacion de la empresa.
         * @var String 
         */
        public $latitud;

        /**
         *Coordenada longitud de la ubicacion de la empresa.
         * @var String 
         */        
        public $longitud;
        
        /**
         *Cantidad de votos de confianza que posee el sitio.
         * @var int  
         */
        public $losvotos;
        
        /**
         *Variable que contiene el codigo html de las experiencias de los sitio. (plantillas/sitios/registrarSitio.html)
         * @var String 
         */
        public $experiencias;        
                
        /**
         *Variable diccionario general de las variables que contienen la estructura general de la interfaz grafica del sitio.
         * @var String  
         */                      
        public $dic_general;
        /**
         *Variable diccionario general de las variables que poseen fracmentos html que generan el contenido de la interfaz grafica del sitio.
         * @var String  
         */           
        public $dic_contenido;        
        


        

        /**
         * Constructor de la clase. 
         * Inicializa la gran mayoria de atributos de la clase
         * 
         * @param String $id Id del sitio.
         */           
        public function __construct($id) {

            $this->id_sitio = $id;
            $this->img_slider_act = '<div class="item active">
                                        <img src="{IMG_NATANE}/{url}" />
                                    </div>';
            $this->img_slider = '<div class="item">
                                    <img src="{IMG_NATANE}/{url}" />
                                </div>';            

        
            $this->base = file_get_contents('../../plantillas/generales/base.html');
            $this->head = file_get_contents('../../plantillas/generales/head.html');
            $this->modal = file_get_contents('../../plantillas/generales/barraModal.html');                                    
            
            $this->sitio = file_get_contents('../../plantillas/sitios/perfilSitio.html');   
            $this->slider_sitio = file_get_contents('../../plantillas/sitios/slider_sitio.html');      
            $this->edita_slider = file_get_contents('../../plantillas/generales/editar_slider.html');      
            $this->contacto = file_get_contents('../../plantillas/sitios/contacto.html'); 
            $this->seguidores = file_get_contents('../../plantillas/generales/seguidores.html');
            $this->gustaria = $this->seguidores;
            $this->ferrocarril = file_get_contents('../../plantillas/generales/ferrocarril.html');
            $this->elemento_ferro = file_get_contents('../../plantillas/generales/elemento_ferro.html');
            $this->editar = file_get_contents('../../plantillas/sitios/editarSitio.html');
            $this->registrar = file_get_contents('../../plantillas/sitios/registrarSitio.html');
            $this->experiencias = file_get_contents('../../plantillas/sitios/experienciaSitio.html');     
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
                            <link href="{CSS}/font-awesome.min.css" rel="stylesheet" />
                            <link href="{CSS}/calificacion.css" rel="stylesheet" />';
    
            
            $this->script = "";
            
            
            $this->dic_general = array('metas' => $this->metas,
                                    'links' => $this->links ,
                                    'script' => $this->script,
                                    'head' => $this->head ,
                                    'contenido' => $this->sitio);

            
            $this->dic_contenido = array('slider_sitio' => $this->slider_sitio, 
                                        'editar_slider' => $this->edita_slider,                
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
                                        'votos' => $this->losvotos, 
                                        'experienciaSitio' => $this->experiencias,
                                        'modales' => $this->modal,                                        
                                        'id_sitio'=>$this->id_sitio);
        }
        
        
        /**
         * Metodo encargado de actualizar los datos de los diccionarios
         * a medida que se van refactorizando y cambiando constantemente.
         * 
         */                
        public function actualizar_diccionarios(){
            
            $this->dic_general = array('metas' => $this->metas,
                                    'links' => $this->links ,
                                    'script' => $this->script,
                                    'head' => $this->head ,
                                    'contenido' => $this->sitio);
            
            $this->dic_contenido = array('slider_sitio' => $this->slider_sitio, 
                                        'editar_slider' => $this->edita_slider,
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
                                        'votos' => $this->losvotos, 
                                        'experienciaSitio' => $this->experiencias,
                                        'modales' => $this->modal,                                        
                                        'id_sitio'=>$this->id_sitio);            
            
        }

        
        

        /**
         * Funcion que refactoriza el header dependiendo del tipo de usuario que lo 
         * esta accediendo.
         * @param int $opcion Indica si existe incializada una sesión
         */
        public function refactory_header($opcion){
            
            switch($opcion){                                
                case 1:
                    
                    $this->head = Global_var::refactory_header(true,false);                    
                    //$this->head .= "<br> <h1>Este es mi Sitio</h1>";
                    break;
                case 2:
                    $this->head = Global_var::refactory_header(true, false);                                        
                    break;
                
                default:
                    $this->head = Global_var::refactory_header(false, false);     
                    break;               
            }
            
        }  
        
        
        /**
         * Refactoriza el eslider principal con las imagenes del sitio.
         * 
         * @param Array $datos Imagenes del sitio
         */        
        public function refactory_slider($datos){   // contruye el slider
            
            if(count($datos)>1){
                $imagenes = str_ireplace("{url}", $datos[0], $this->img_slider_act); // carga la imagen principal del slider

                for($i=1; $i<count($datos); $i++){  // carga el resto de imagenes                             
                    $imagenes .= str_ireplace("{url}", $datos[$i], $this->img_slider);
                }            

                $this->slider_sitio = str_ireplace("{imagenes}", $imagenes, $this->slider_sitio);   // se remplazan todas las imagenes sobre el template de slider
                
            }
            else{                
                $imagenes = str_ireplace("{url}", $datos, $this->img_slider);
                $this->slider_sitio = str_ireplace("{imagenes}", $imagenes, $this->slider_sitio);   // se remplazan todas las imagenes sobre el template de slider
            }
            
            $this->actualizar_diccionarios();
        }
        
        
        
        /**
         * Refactoriza la sección de contacto del sitio.
         * @param Array $datos Dados de contacto del sitio.
         */        
        public function refactory_contacto($datos){                
            
            $this->nombre = $datos[0]->nombre;
            $this->contacto = str_ireplace('{tel}', $datos[0]->telefono, $this->contacto );
            $this->contacto = str_ireplace('{dir}', $datos[0]->direccion, $this->contacto );
            $this->contacto = str_ireplace('{correo}', $datos[0]->correo, $this->contacto );
            $this->contacto = str_ireplace('{facebook}', $datos[0]->facebook, $this->contacto );
            $this->contacto = str_ireplace('{twitter}', $datos[0]->twitter, $this->contacto );
            $this->contacto = str_ireplace('{google}', $datos[0]->youtube, $this->contacto );        
            
            $this->losvotos = $datos[0]->votos;
            $this->descripcion = $datos[0]->descripcion;

            $this->actualizar_diccionarios();
        }
        
        
        /**
         * Refactoriza la sección de visitantes del sitio.
         * @param type $datos Datos de los visitantes del sitio.
         */
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
        

        /**
         * Refactoriza la sección de "Gustaria" del sitio.
         * @param Array $datos Datos de los usuarios que les gustaria ir al sito.
         */
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
        
        /**
         * Refactoriza el ferrocarril de sitios relacionados.
         * @param Array $datos Datos sobre sitios relacionados.
         */
        public function refactory_ferrocarril($datos){  // contruye el ferrocarril
            
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
     
        /**
         * Refactoriza la seccion de experiencias publicadas por los usuarios.
         * @param Array $datos Datos las experiencias relacionadas al sitio.
         */
        public function refactory_experiencias($datos){            
            
            $experiencias_sitio = "";

            for($c=0; count($datos); $c++){                
                
                $experiencias_sitio .= '<div class="row-fluid">';                            
                $i=0;
                do{ 
                    $expe=array_shift($datos);
                    $aux = $this->experiencias;
                    $aux = str_ireplace('{id_experiencia}', $expe->id, $aux);                
                    $aux = str_ireplace('{imagen}', $expe->imagen, $aux);
                    $aux = str_ireplace('{titulo}', $expe->nombre, $aux);
                    $aux = str_ireplace('{descripcion}', $expe->descripcion , $aux);
                    $experiencias_sitio .= $aux;
                    $i++;
                }while((count($datos)!=0)&& $i<3);                
                
                $experiencias_sitio .= '</div>';
            }            
            
            $this->experiencias = $experiencias_sitio;            
            $this->actualizar_diccionarios();
                        
        }               
        
        /**
         * Refactoriza todo el contenido de la interfaz grafica del sitio.
         */               
        public function refactory_contenido(){            
            
            foreach($this->dic_contenido as $clave=>$valor){
               
                $this->sitio = str_ireplace('{'.$clave.'}', $valor, $this->sitio);
                
            }           
            $this->actualizar_diccionarios();
        }        
        
        /**
         * Refactoriza la pagina total, inserta: metas, liks y contenido para final mente retornar 
         * toda la pagina y ser mostrado usuario final.
         * 
         * @return String Html final de la pagina para mostrar.
         */                                          
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