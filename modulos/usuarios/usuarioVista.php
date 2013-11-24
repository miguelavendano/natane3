<?php

    require_once '../../core/global_var.php';

    class UsuarioVista{
        
        public $base;
        public $head;
        public $modal;
        public $links;
        public $metas;
        public $script;

        public $segui;
        public $usuario;
        public $editar;
        public $expe;
        public $gustaria;
        public $perfil;
        public $comparte;
        public $editExp;
        public $creaSitio;
        public $creaEmpre;
        
        public $dic_general;
        public $dic_contenido;
        public $dic_datos_user;        
        
        
        
        public function __construct() {
            
            $this->base = file_get_contents('../../plantillas/generales/base.html');
            $this->head = file_get_contents('../../plantillas/generales/head.html');
            $this->modal = file_get_contents('../../plantillas/generales/barraModal.html');
            
            
            $this->perfil = file_get_contents('../../plantillas/usuario/perfilUsuario.html');
            $this->segui = file_get_contents('../../plantillas/generales/seguidores.html');
            $this->usuario = file_get_contents('../../plantillas/usuario/datos_usuario.html');
            $this->editar = file_get_contents('../../plantillas/usuario/editarUsuario.html');
            $this->expe = file_get_contents('../../plantillas/usuario/experiencia.html');            
            $this->comparte = file_get_contents('../../plantillas/usuario/compartirExperiencia.html');
            $this->editExp = file_get_contents('../../plantillas/usuario/editarExperiencia.html');
            $this->creaSitio = file_get_contents('../../plantillas/sitios/registrarSitio.html');
            $this->creaEmpre = file_get_contents('../../plantillas/empresas/registrarEmpresa.html');
            
            
            $this->gustaria = $this->expe;
                     
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
            
            $this->dic_contenido = array('datos_usuario' => $this->usuario, 
                                        'seguidores' => $this->segui, 
                                        'le_gustaria_ir' => $this->gustaria,
                                        'modales'=> $this->modal,
                                        'editarUsuario'=>$this->editar,
                                        'experiencia'=>$this->expe,
                                        'comparteExp'=>$this->comparte,
                                        'editaExp'=>$this->editExp,
                                        'registrarSitio'=>$this->creaSitio,
                                        'registrarrEmpresa'=>$this->creaEmpre                    
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
            
            $this->dic_contenido['datos_usuario'] = $this->usuario;
            $this->dic_contenido['seguidores'] = $this->segui;
            $this->dic_contenido['le_gustaria_ir'] = $this->gustaria;
            $this->dic_contenido['modales']= $this->modal;
            $this->dic_contenido['editarUsuario']= $this->editar;
            $this->dic_contenido['experiencia']=$this->expe;
            $this->dic_contenido['comparteExp']=$this->comparte;
            $this->dic_contenido['editaExp']=$this->editExp;                    
            $this->dic_contenido['registrarSitio']=$this->creaSitio;
            $this->dic_contenido['registrarEmpresa']=$this->creaEmpre;       
        }
        
        
        
        /**
         * Funcion que refactoriza el header dependiendo del tipo de usuario que lo 
         * esta accediendo.
         */
        public function refactory_header($opcion){
            
            switch($opcion){                                
                case 1:
                    
                    
                    $this->head = Global_var::refactory_header(false);                    
                    $this->head .= "<br> <h1>Este es mi perfil</h1>";
                    
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
        public function refactory_usuario($datos){
                
            //$this->usuario = str_ireplace('{nombre}',$datos[0]->nick ,$this->usuario );
            $this->usuario = str_ireplace('{nombre}',$datos[0]->nombre." ".$datos[0]->apellido,$this->usuario );
            $this->usuario = str_ireplace('{genero}',$datos[0]->genero ,$this->usuario );
            $this->usuario = str_ireplace('{imagen}',$datos[0]->imagen ,$this->usuario );
            $this->usuario = str_ireplace('{f_nacimiento}',$datos[0]->fecha_nacimiento ,$this->usuario );
            $this->usuario = str_ireplace('{correo}',$datos[0]->correo ,$this->usuario );
            $this->usuario = str_ireplace('{pais_origen}',$datos[0]->lugar_recidencia ,$this->usuario );
            $this->usuario = str_ireplace('{web_site}',$datos[0]->sitio_web ,$this->usuario );

            $this->actualizar_diccionarios();          

        }
        
        /**
         * Refactoriza los enlaces de amistad que posee el usuario.
         * 
         * @param array $datos trae los datos de los usuarios amigos del usuario actual.
         */                                      
        public function refactory_amigos($datos){
            
            $complete = "";            
            
            foreach ($datos as $valor){
                $global = new Global_var();
                $empresa = '';
                $nombre = '';
                $url = '';
                $aux = $this->segui;
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
            
            $this->segui = $complete;
            $this->actualizar_diccionarios();
        }
        
        
        /**
         * Refactoriza los datos de las experiencias que ha publicado el usuario.
         * 
         * @param array $datos trae los datos de las experiencias del usuario
         */                                      
        public function refactory_experiencias($datos){            
            
            $experiencias = "";
            
            foreach ($datos as $valor){
                $aux = $this->expe;
                $aux = str_ireplace('{id_experiencia}', $valor->id, $aux);                
                $aux = str_ireplace('{imagen}', $valor->imagen, $aux);                    
                $aux = str_ireplace('{dirigido_a}', $valor->nombre, $aux);
                $aux = str_ireplace('{comentario}', $valor->descripcion, $aux);
                
                $experiencias .= $aux;
            }
            
            $this->expe = $experiencias;
            
            $this->actualizar_diccionarios();
            
            
        }
        
        
        /**
         * Refactoriza datos basicos sobre sitios que al usuario le gustaria ir
         * 
         * @param array $datos trae los datos de los sitios con enlace gustaria.
         */                              
        public function refactory_gustaria($datos){            
            
            $quiere = "";
            
            foreach ($datos as $valor){
                $aux = $this->gustaria;
                $aux = str_ireplace('{imagen}', $valor->img, $aux);
                $aux = str_ireplace('{dirigido_a}', $valor->name, $aux);
                $aux = str_ireplace('{comentario}', "Uff bacanisimo este sitio me gustaria ir definitivamente", $aux);
                
                $quiere .= $aux;
            }
            
            $this->gustaria = $quiere;
            
            $this->actualizar_diccionarios();
            
            
        }        
             
        /**
         * Convierte todas las secciones refactorizadas individualemtne en una sola cadena de texto 
         * para finalmente ser empotrada en la plantilla base.
         * 
         * @param array $datos trae los datos del usuario.
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
