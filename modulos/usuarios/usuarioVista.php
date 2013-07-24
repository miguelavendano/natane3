<?php

    require_once '../../core/global_var.php';

    class UsuarioVista{
        
        public $base;
        public $head;
        public $modal;
        public $links;
        public $metas;

        public $segui;
        public $usuario;
        public $expe;
        public $gustaria;
        public $perfil;
        
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
            $this->editar = file_get_contents('../../plantillas/usuario/editar_perfil.html');
            $this->expe = file_get_contents('../../plantillas/usuario/experiencia.html');            
            
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
            
            
            $this->dic_general = array( 'metas' => $this->metas,
                                        'links' => $this->links ,
                                        'head' => $this->head ,
                                        'contenido' => $this->perfil
                                        );
            
            $this->dic_contenido = array('datos_usuario' => $this->usuario, 
                                        'seguidores' => $this->segui, 
                                        'le_gustaria_ir' => $this->gustaria,
                                        'modales'=> $this->modal,
                                        'editar_perfil'=>$this->editar,
                                        'experiencia'=>$this->expe);
        }
        
        
        public function actualizar_diccionarios(){
            
            $this->dic_general = array( 'metas' => $this->metas,
                                        'links' => $this->links ,
                                        'head' => $this->head ,
                                        'contenido' => $this->perfil);
            
            $this->dic_contenido = array('datos_usuario' => $this->usuario, 
                                        'seguidores' => $this->segui, 
                                        'le_gustaria_ir' => $this->gustaria,
                                        'modales'=> $this->modal,
                                        'editar_perfil'=> $this->editar,
                                        'experiencia'=>$this->expe);           
        }
        
        public function refactory_usuario($datos){
                
            $this->usuario = str_ireplace('{nombre}',$datos[0]->nick ,$this->usuario );
            $this->usuario = str_ireplace('{genero}',$datos[0]->genero ,$this->usuario );
            $this->usuario = str_ireplace('{imagen}',$datos[0]->imagen ,$this->usuario );
            $this->usuario = str_ireplace('{f_nacimiento}',$datos[0]->fecha_nacimiento ,$this->usuario );
            $this->usuario = str_ireplace('{correo}',$datos[0]->correo ,$this->usuario );
            $this->usuario = str_ireplace('{pais_origen}',$datos[0]->lugar_recidencia ,$this->usuario );
            $this->usuario = str_ireplace('{web_site}',$datos[0]->sitio_web ,$this->usuario );

            $this->actualizar_diccionarios();
            


        }
        
        public function refactory_amigos($datos){
            
            $complete = "";
            
            
            foreach ($datos as $valor){
                $global = new Global_var();
                $empresa = '';
                $nombre = '';
                $url = '';
                $aux = $this->segui;
                echo $valor->type;
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
        
        
        
        public function refactory_experiencias($datos){            
            
            $experiencias = "";
            
            foreach ($datos as $valor){
                $aux = $this->expe;
                $aux = str_ireplace('{imagen}', $valor->imagen, $aux);
                $aux = str_ireplace('{dirigido_a}', $valor->nombre, $aux);
                $aux = str_ireplace('{comentario}', $valor->descripcion, $aux);
                
                $experiencias .= $aux;
            }
            
            $this->expe = $experiencias;
            
            $this->actualizar_diccionarios();
            
            
        }
        

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
             
        
        public function refactory_contenido(){            
            
            foreach($this->dic_contenido as $clave=>$valor){
               
                $this->perfil = str_ireplace('{'.$clave.'}', $valor, $this->perfil);
                
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
