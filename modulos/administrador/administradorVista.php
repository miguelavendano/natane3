<?php

    require_once '../../core/global_var.php';

    class AdministradorVista{
        
        public $base;
        public $head;
        public $modal;
        public $links;
        public $metas;
        public $script;

        public $admin;
        public $editar;
        public $noticias;
        public $eventos;
        public $perfil;
        public $creaSitio;
        public $creaEmpre;
        
        public $dic_general;
        public $dic_contenido;
        public $dic_datos_user;        
        
        
        
        public function __construct() {
            
            $this->base = file_get_contents('../../plantillas/generales/base.html');
            $this->head = file_get_contents('../../plantillas/generales/head.html');
            $this->modal = file_get_contents('../../plantillas/generales/barraModal.html');
            
            
            $this->perfil = file_get_contents('../../plantillas/administrador/perfilAdministrador.html');
            $this->admin = file_get_contents('../../plantillas/administrador/datos_usuario.html');
            $this->editar = file_get_contents('../../plantillas/administrador/editarAdministrador.html');
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
                                        'registrarSitio'=>$this->creaSitio,
                                        'registrarEmpresa'=>$this->creaEmpre                    
                                        );
        }
        

        /**
         * Funcion encargada de actualizar los datos de los diccionarios
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

            $this->dic_contenido['registrarSitio'] = $this->creaSitio;
            $this->dic_contenido['registrarEmpresa'] = $this->creaEmpre;       
        }
        
        
        
        /**
         * Funcion que refactoriza el header dependiendo del tipo de usuario que lo 
         * esta accediendo.
         */
        public function refactory_header($opcion){
            
            switch($opcion){                                
                case 1:
                    
                    $this->head = Global_var::refactory_header(false);                                        
                    
                break;
            
                case 2:
                    $this->head = Global_var::refactory_header(false); 
                    
                break;                
                
                default:
                    
                break;               
            }
                 
        }
        
        
        /**
         * Refactoriza los datos del usuario, nombre, apellidos, telefono y demas
         * 
         * @param array $datos trae los datos del usuario.
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
         * Refactoriza los datos de las noticas que publico el administrador         * 
         * @param array $datos trae los datos de las noticias.
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
         * @param array $datos trae los datos de los eventos.
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
                    $resultados .= $aux;
                    $i++;
                }while((count($datos)!=0)&& $i<3);                
                
                $resultados .= '</div>';
            }
            
            $this->eventos = $resultados;
            $this->actualizar_diccionarios();
        }        
        
        
        

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
