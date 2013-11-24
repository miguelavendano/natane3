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
        public $amigos;
        public $perfil;
        public $comparte;
        public $editExp;
        public $verExp;
        public $creaSitio;
        public $creaEmpre;
        
        public $dic_general;
        public $dic_contenido;
        public $dic_datos_user;        
        
        
        
        public function __construct() {
            
            $this->base = file_get_contents('../../plantillas/generales/base.html');
            $this->head = file_get_contents('../../plantillas/generales/headUsuario.html');
            $this->modal = file_get_contents('../../plantillas/generales/barraModal.html');                                    
            
            
            $this->perfil = file_get_contents('../../plantillas/usuario/perfilUsuario.html');
            $this->segui = file_get_contents('../../plantillas/generales/seguidores.html');
            $this->usuario = file_get_contents('../../plantillas/usuario/datos_usuario.html');
            $this->editar = file_get_contents('../../plantillas/usuario/editarUsuario.html');
            $this->expe = file_get_contents('../../plantillas/usuario/experiencia.html');            
            $this->comparte = file_get_contents('../../plantillas/usuario/compartirExperiencia.html');
            $this->editExp = file_get_contents('../../plantillas/usuario/editarExperiencia.html');
            $this->verExp = file_get_contents('../../plantillas/usuario/verExperiencia.html');
            $this->creaSitio = file_get_contents('../../plantillas/sitios/registrarSitio.html');
            $this->creaEmpre = file_get_contents('../../plantillas/empresas/registrarEmpresa.html');                        
            $this->gustaria = file_get_contents('../../plantillas/usuario/sitiosAvisitar.html');            
            $this->amigos = file_get_contents('../../plantillas/usuario/amigos.html');            
                     
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
                                        'head' => $this->head ,
                                        'contenido' => $this->perfil
                                        );
            
            $this->dic_contenido = array('datos_usuario' => $this->usuario, 
                                        'seguidores' => $this->segui, 
                                        'quiere_visitar' => $this->gustaria,
                                        'amigos_de_amigos' => $this->amigos,
                                        'modales'=> $this->modal,
                                        'editarUsuario'=>$this->editar,
                                        'experiencia'=>$this->expe,
                                        'comparteExp'=>$this->comparte,
                                        'editaExp'=>$this->editExp,
                                        'verExp'=>$this->verExp,
                                        'registrarSitio'=>$this->creaSitio,
                                        'registrarrEmpresa'=>$this->creaEmpre                    
                                        );
        }
        
        
        public function actualizar_diccionarios(){
            
            $this->dic_general = array( 'metas' => $this->metas,
                                        'links' => $this->links ,
                                        'script' => $this->script,
                                        'head' => $this->head ,
                                        'contenido' => $this->perfil
                                        );
            
            $this->dic_contenido = array('datos_usuario' => $this->usuario, 
                                        'seguidores' => $this->segui, 
                                        'quiere_visitar' => $this->gustaria,
                                        'amigos_de_amigos' => $this->amigos,
                                        'modales'=> $this->modal,
                                        'editarUsuario'=> $this->editar,
                                        'experiencia'=>$this->expe,
                                        'comparteExp'=>$this->comparte,
                                        'editaExp'=>$this->editExp,                    
                                        'verExp'=>$this->verExp,
                                        'registrarSitio'=>$this->creaSitio,
                                        'registrarEmpresa'=>$this->creaEmpre                    
                                        );           
        }
        
        public function refactory_usuario($datos){
                
            $this->usuario = str_ireplace('{nick}',$datos[0]->nick ,$this->usuario );
            $this->usuario = str_ireplace('{nombre}',$datos[0]->nombre." ".$datos[0]->apellido,$this->usuario );
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
        
        
        
        public function refactory_experiencias($datos){            
            
            $experiencias = "";
            
            foreach ($datos as $valor){
                $aux = $this->expe;
                $aux = str_ireplace('{id_experiencia}', $valor->id, $aux);                
                $aux = str_ireplace('{imagen}', $valor->imagen, $aux);                    
                $aux = str_ireplace('{titulo_exp}', $valor->nombre, $aux);
                $aux = str_ireplace('{comentario}', $valor->descripcion, $aux);
                
                $experiencias .= $aux;
            }
            
            $this->expe = $experiencias;            
            $this->actualizar_diccionarios();
        }
        

        public function refactory_visitaria($datos){            
            
            $global = new Global_var();
            $url = $global->url_sitio;
            $quiere = "";
            
            foreach ($datos as $valor){
                $aux = $this->gustaria;
                //$aux = str_ireplace('{imagen}', $valor->img, $aux);
                $aux = str_ireplace('{sitio}', $valor->nombre, $aux);
                $aux = str_ireplace('{descripcion}', $valor->descripcion, $aux);
                $aux = str_ireplace('{url}', $url, $aux);                
                $aux = str_ireplace('{id_sitio}', $valor->id, $aux);                
                
                $quiere .= $aux;
            }
            
            $this->gustaria = $quiere;
            
            $this->actualizar_diccionarios();
            
            
        }        


        public function refactory_AmigosDeAmigos($datos){
            
            $complete = "";            
            
            foreach ($datos as $valor){
                $global = new Global_var();
                $empresa = '';
                $nombre = '';
                $url = '';
                $aux = $this->amigos;
                //echo $valor->type;
                if($valor->type == "Empresa"){                                    	         
                    $empresa = 'style="background-color: #CBFEC1"';
                    $nombre = $valor->nombre;
                    $url = $global->url_empresa;
                }else{
                    //$nombre = $valor->nick;
                    $nombre = $valor->nombre." ".$valor->apellido;
                    $url = $global->url_usuario;
                }            
                $aux = str_ireplace('{empresa}', $empresa, $aux);            
                $aux = str_ireplace('{id}', $valor->id, $aux);
                $aux = str_ireplace('{url}', $url, $aux);
                $aux = str_ireplace('{imagen}', $valor->imagen, $aux);
                $aux = str_ireplace('{nombre}', $nombre, $aux);
                //$aux = str_ireplace('{amigo}', $amigo, $aux);
                $complete .= $aux;
            }
            
            $this->amigos = $complete;
            $this->actualizar_diccionarios();

        }

        
        
        /*
        public function refactory_AmigosDeAmigos($datos){
            
            $complete = "";            
            
            foreach ($datos as $valor){
                $global = new Global_var();
                $empresa = '';
                $nombre_a = '';
                $nombre_u = '';
                $url = '';
                $aux = $this->amigos;

                if($valor->type_amigo == "Empresa"){                                    	         
                    $empresa = 'style="background-color: #CBFEC1"';
                    $nombre_a = $valor->nombre_amigo;
                    $url_usuario = $global->url_empresa;
                }else{
                    //$nombre_a = $valor->nick_amigo;
                    $nombre_a = $valor->nombre_amigo;
                    $url_usuario = $global->url_usuario;
                }            

                if($valor->type_usuario == "Empresa"){                                    	         
                    $empresa = 'style="background-color: #CBFEC1"';
                    $nombre_u = $valor->nombre_usuario;
                    $url_usuario = $global->url_empresa;
                }else{
                    //$nombre_u = $valor->nick_usuario;
                    $nombre_u = $valor->nombre_usuario;
                    $url_usuario = $global->url_usuario;
                }                            
                
                $aux = str_ireplace('{empresa}', $empresa, $aux);            
                $aux = str_ireplace('{url_conocido}', $url_usuario, $aux);
                $aux = str_ireplace('{id_conocido}', $valor->id_usuario, $aux);
                $aux = str_ireplace('{img_conocido}', $valor->img_usuario, $aux);
                $aux = str_ireplace('{nom_conocido}', $nombre_u, $aux);
                $aux = str_ireplace('{url_amigo}', $url_usuario, $aux);
                $aux = str_ireplace('{id_amigo}', $valor->id_amigo, $aux);
                $aux = str_ireplace('{img_amigo}', $valor->img_amigo, $aux);
                $aux = str_ireplace('{nom_amigo}', $nombre_a, $aux);
                                
                $complete .= $aux;
            }
            
            $this->amigos = $complete;
            $this->actualizar_diccionarios();

        }
        */        
        
        
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
