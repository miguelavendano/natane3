<?php

    require_once '../../core/global_var.php';

    
    
    
    /**
     * Clase controlador de los elementos html5 utilizados en el modulo administrador.
     * 
     */
    class AdministradorVista{
        
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
         *Variable que contiene el codigo html para mostrar la informacion del usuario(plantillas/administrador/datos_usuario.html)
         * @var String  
         */
        public $admin;
        /**
         *Variable que contiene el codigo html para mostrar el formulario de edición de datos. (plantillas/administrador/editarAdministrador.html)
         * @var String  
         */        
        public $editar;
        /**
         *Variable que contiene el codigo html para listar los usuarios con mas seguidores. (plantillas/index/listaUsuarios.html)
         * @var String  
         */        
        public $populares;
        /**
         *Variable que contiene el codigo html para listar los usuarios con mas seguidores. (plantillas/index/listaUsuarios.html)
         * @var String
         */        
        public $comparten;
        /**
         *Variable que contiene el codigo html de las noticias. (plantillas/administrador/noticias.html)          
         * @var String
         */        
        public $noticias;
        /**
         *Variable que contiene el codigo html de los eventos. (plantillas/administrador/eventos.html)
         * @var String  
         */        
        public $eventos;
        /**
         *Variable que contiene el codigo html de la estructura del perfil del administrador. (plantillas/administrador/perfilAdministrador.html)
         * 
         * @var String  
         */        
        public $perfil;
        /**
         *Variable que contiene el codigo html del formulario para crear un nuevo sitio (plantillas/administrador/perfilAdministrador.html)
         * @var String  
         */        
        public $creaSitio;
        /**
         *Variable que contiene el codigo html del formulario para crear una nueva empresa (plantillas/empresas/registrarEmpresa.html)
         * 
         * @var String  
         */        
        public $creaEmpre;
        /**
         *Variable diccionario general de las variables que contienen la estructura general de la interfaz grafica del Administrador
         * 
         * @var String  
         */              
        public $dic_general;
        /**
         *Variable diccionario general de las variables que poseen fracmentos html que generan el contenido de la interfaz grafica del Administrador.
         * @var String  
         */        
        public $dic_contenido;

        //public $dic_datos_user;        
        
        
        
        /**
         * Constructor de la clase.
         * 
         * Inicializa la gran mayoria de atributos de la clase
         */
        public function __construct() {
            
            $this->base = file_get_contents('../../plantillas/generales/base.html');
            $this->head = file_get_contents('../../plantillas/generales/head.html');
            $this->modal = file_get_contents('../../plantillas/generales/barraModal.html');
            
            
            $this->perfil = file_get_contents('../../plantillas/administrador/perfilAdministrador.html');
            $this->admin = file_get_contents('../../plantillas/administrador/datos_usuario.html');
            $this->editar = file_get_contents('../../plantillas/administrador/editarAdministrador.html');
            $this->populares = file_get_contents('../../plantillas/index/listaUsuarios.html');
            $this->comparten = file_get_contents('../../plantillas/index/listaUsuarios.html');
            $this->noticias = file_get_contents('../../plantillas/administrador/noticias.html');            
            $this->eventos = file_get_contents('../../plantillas/administrador/eventos.html');                        
            $this->creaSitio = file_get_contents('../../plantillas/sitios/registrarSitio.html');
            $this->creaEmpre = file_get_contents('../../plantillas/empresas/registrarEmpresa.html');                        
                     
            $this->metas = '<meta charset="utf-8">
                            <title> {TITULO}</title>
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <meta name="description" content="">
                            <meta name="author" content="">';
            
            $this->links='  <link href="{CSS}/bootstrap.css" rel="stylesheet" />    
                            <link href="{CSS}/bootstrap-responsive.css" rel="stylesheet" /> 
                            
                            <link href="{CSS}/estilos.css" rel="stylesheet" />
                            <link href="{CSS}/estilos_perfil_usuario.css" rel="stylesheet" />    
                            
                            <link href="{CSS}/estilos_modal.css" rel="stylesheet" />
                            <link href="{CSS}/datepicker.css" rel="stylesheet" />
                            <link href="{CSS}/font-awesome.min.css" rel="stylesheet" />                               
                            <link href="{CSS}/jquery.jscrollpane.css" rel="stylesheet" />';            
            
            
            $this->script = "";
            
            
            $this->dic_general = array( 'metas' => $this->metas,
                                        'links' => $this->links ,
                                        'script' => $this->script,
                                        'head'=>$this->head,
                                        'contenido' => $this->perfil
                                        );
            
            $this->dic_contenido = array('datos_admin' => $this->admin, 
                                        'modales'=> $this->modal,
                                        'editarUsuario'=>$this->editar,
                                        'noticias'=>$this->noticias,
                                        'eventos'=>$this->eventos,
                                        'listaPopulares'=>$this->populares,
                                        'listaComparten'=>$this->comparten,
                                        'registrarSitio'=>$this->creaSitio,
                                        'registrarEmpresa'=>$this->creaEmpre                    
                                        );
        }
        

        /**
         * Metodo encargado de actualizar los datos de los diccionarios
         * a medida que se van refactorizando y cambiando constantemente.
         * 
         */
        public function actualizar_diccionarios(){
                        
            
            $this->dic_general['metas'] = $this->metas;
            $this->dic_general['links'] = $this->links;
            $this->dic_general['script'] = $this->script;
            $this->dic_general['head'] = $this->head;                                     
            $this->dic_general['contenido'] = $this->perfil;            
            
            $this->dic_contenido['datos_admin'] = $this->admin;
            
            $this->dic_contenido['modales'] = $this->modal;
            $this->dic_contenido['editarUsuario'] = $this->editar;
            $this->dic_contenido['noticias'] = $this->noticias;
            $this->dic_contenido['eventos'] = $this->eventos;
            
            $this->dic_contenido['listaPopulares'] = $this->populares;
            $this->dic_contenido['listaComparten'] = $this->comparten;

            $this->dic_contenido['registrarSitio'] = $this->creaSitio;
            $this->dic_contenido['registrarEmpresa'] = $this->creaEmpre;       
        }
        
        
        
        /**
         * Funcion que refactoriza el header dependiendo del tipo de usuario que lo 
         * esta accediendo.
         * 
         * @param Boolean $login Indica si existe incializada una sesión
         */
        public function refactory_header($login){          
        
            $ruta ="../../plantillas/generales/";
                        
            if($login){                
                
                $header = file_get_contents($ruta.'headLogin.html');
                $headeadmin = file_get_contents($ruta.'headAdmin.html');
                                
                //$opciones_admin = $crear_evento.$crear_noticia;                  
                
                $headeadmin = str_ireplace('{nick}',$_SESSION['nick'],$headeadmin);         
                $headeadmin = str_ireplace('{img_user}',$_SESSION['img'],$headeadmin);     
                $headeadmin = str_ireplace('{id_user}',$_SESSION['id'],$headeadmin);  
                
                $this->head = str_ireplace('{opciones_login}',$headeadmin,$header);               
                        
            
            }
                   
        }
        
        
        /**
         * Refactoriza los datos del usuario, nombre, apellidos, telefono y demas
         * 
         * @param array $datos Contiene los datos del usuario.
         */                              
        public function refactory_administrador($datos){
                
            $this->admin = str_ireplace('{nombre}',$datos[0]->nombre." ".$datos[0]->apellido,$this->admin );
            $this->admin = str_ireplace('{imagen}',$datos[0]->imagen ,$this->admin );
            //$this->usuario = str_ireplace('{genero}',$datos[0]->genero ,$this->usuario );            
            //$this->usuario = str_ireplace('{f_nacimiento}',$datos[0]->fecha_nacimiento ,$this->usuario );
            $this->admin = str_ireplace('{correo}',$datos[0]->correo ,$this->admin );

            $this->actualizar_diccionarios();          
        }

        
        /**
         * Refactoriza indicadores que se le mostraran al administrador, pueden ser los populares o los que mas coparten expereincias
         * @param array $datos Contiene los datos de los idicadores
         * @param array $tipo especifica el tipo de indicadores a mostrar (populares o comparten)
         */   
        public function refactory_usuariosAdmin($datos,$tipo){
                        
            $lusuarios = "";            
            $aux="";
            
            for($i=0; count($datos); $i++){                
                
                $lusuarios .= '<div class="row-fluid">';                            
                $c=0;
                do{ 
                    $valor=array_shift($datos);
                   
                    $global = new Global_var();
                    $aux = $this->$tipo;    
                    $aux = str_ireplace('{id}', $valor->id, $aux);
                    $aux = str_ireplace('{url}', $global->url_usuario, $aux);
                    $aux = str_ireplace('{imagen}', $valor->imagen, $aux);
                    $aux = str_ireplace('{nick}', $valor->nick, $aux);
                    $lusuarios .= $aux;
                    $c++;
                }while((count($datos)!=0)&& $c<3);                
                
                $lusuarios .= '</div>';                
            }            
            
            //echo $lusuarios;
            $this->$tipo = $lusuarios;            
            $this->$tipo = str_ireplace("{listaPopulares}", $lusuarios, $this->$tipo);                        
        }        
        
        
        /**
         * Refactoriza los datos de las noticas que publico el administrador.
         * @param array $datos Contiene los datos de las noticias.
         */                              
        public function refactory_noticias($datos){            
            
            $resultados="";
            
            for($c=0; count($datos); $c++){                
                
                $resultados .= '<div class="row-fluid">';                            
                $i=0;
                do{ 
                    $servicio=array_shift($datos);
                    $aux = $this->noticias;
                    $aux = str_ireplace("{id_noticia}", $servicio->id, $aux);
                    $aux = str_ireplace("{nombre}", $servicio->nombre, $aux);
                    $aux = str_ireplace("{imagen}", $servicio->imagen, $aux);
                    $aux = str_ireplace("{descripcion}", $servicio->descripcion, $aux);
                    $aux = str_ireplace("{tipo}", $servicio->type, $aux);
                    $resultados .= $aux;
                    $i++;
                }while((count($datos)!=0)&& $i<3);                
                
                $resultados .= '</div>';
            }
            
            $this->noticias = $resultados;
            $this->actualizar_diccionarios();
        }
        
        
        /**
         * Refactoriza los datos de los eventos que publico el administrador         * 
         * @param array $datos Contiene los datos de los eventos.
         */                              
        public function refactory_eventos($datos){            
            
            $resultados="";
            
            for($c=0; count($datos); $c++){                
                
                $resultados .= '<div class="row-fluid">';                            
                $i=0;
                do{ 
                    $servicio=array_shift($datos);
                    $aux = $this->eventos;
                    $aux = str_ireplace("{id_evento}", $servicio->id, $aux);
                    $aux = str_ireplace("{nombre}", $servicio->nombre, $aux);
                    $aux = str_ireplace("{imagen}", $servicio->imagen, $aux);
                    $aux = str_ireplace("{descripcion}", $servicio->descripcion, $aux);
                    $aux = str_ireplace("{fecha_evento}", $servicio->fecha_evento, $aux);
                    $aux = str_ireplace("{hora_evento}", $servicio->hora_evento, $aux);
                    $aux = str_ireplace("{tipo}", $servicio->type, $aux);
                    $resultados .= $aux;
                    $i++;
                }while((count($datos)!=0)&& $i<3);                
                
                $resultados .= '</div>';
            }
            
            $this->eventos = $resultados;
            $this->actualizar_diccionarios();
        }        
        
        
        
        /**
         * Refactoriza todo el contenido de la interfaz grafica del Administrador
         */
        public function refactory_contenido(){            
            
            foreach($this->dic_contenido as $clave=>$valor){
               
                $this->perfil = str_ireplace('{'.$clave.'}', $valor, $this->perfil);
                
            }           
            $this->actualizar_diccionarios();
        }        
        
        
        
        /**
         * Refactoriza la pagina total, inserta: metas, liks y contenido para final mente retornar 
         * toda la pagina y ser mostrado usuario final.
         * 
         * @return cadena_caracteres html final de la pagina para mostrar.
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
