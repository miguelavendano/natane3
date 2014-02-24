<?php

    require_once '../../core/global_var.php';

    class AdministradorVista{
        
        public $base;
        public $head;
        public $modal;
        public $links;
        public $metas;
        public $script;

        public $segui;
        public $sigo;
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
            $this->head = file_get_contents('../../plantillas/generales/head.html');
            $this->modal = file_get_contents('../../plantillas/generales/barraModal.html');
            
            
            $this->perfil = file_get_contents('../../plantillas/usuario/perfilUsuario.html');
            $this->segui = file_get_contents('../../plantillas/generales/seguidores.html');
            $this->sigo = file_get_contents('../../plantillas/generales/seguidores.html');            
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
                                        'head'=>$this->head,
                                        'contenido' => $this->perfil
                                        );
            
            $this->dic_contenido = array('datos_usuario' => $this->usuario, 
                                        'seguidores' => $this->segui, 
                                        'siguiendo' => $this->sigo,
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
            $this->dic_contenido['siguiendo'] = $this->sigo;
            
            $this->dic_contenido['modales']= $this->modal;
            $this->dic_contenido['editarUsuario']= $this->editar;
            $this->dic_contenido['experiencia']=$this->expe;
            $this->dic_contenido['comparteExp']=$this->comparte;
            $this->dic_contenido['editaExp']=$this->editExp;
            
            $this->dic_contenido['quiere_visitar']=$this->gustaria;
            $this->dic_contenido['amigos_de_amigos']=$this->amigos;
            
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
                    
                    break;
                case 2:
                    $this->head = Global_var::refactory_header(false); 
                    
                    break;
                
                default:
                    
                    break;               
            }
            

//            $this->dic_general = array( 'metas' => $this->metas,
//                                        'links' => $this->links ,
//                                        'script' => $this->script,
//                                        'head' => $this->head ,
//                                        'contenido' => $this->perfil
//                                        );
//            
//            $this->dic_contenido = array('datos_usuario' => $this->usuario, 
//                                        'seguidores' => $this->segui, 
//                                        'quiere_visitar' => $this->gustaria,
//                                        'amigos_de_amigos' => $this->amigos,
//                                        'modales'=> $this->modal,
//                                        'editarUsuario'=> $this->editar,
//                                        'experiencia'=>$this->expe,
//                                        'comparteExp'=>$this->comparte,
//                                        'editaExp'=>$this->editExp,                    
//                                        'verExp'=>$this->verExp,
//                                        'registrarSitio'=>$this->creaSitio,
//                                        'registrarEmpresa'=>$this->creaEmpre                    
//                                        );           
        }
        
        
        /**
         * Refactoriza los datos del usuario, nombre, apellidos, telefono y demas
         * 
         * @param array $datos trae los datos del usuario.
         */                              
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
        
        /**
         * Refactoriza los enlaces de amistad que posee el usuario.
         * 
         * @param array $datos trae los datos de los usuarios amigos del usuario actual.
         */                                      
        public function refactory_amigos($datos,$tipo){

            $complete = "";            
            
            foreach ($datos as $valor){
                $global = new Global_var();
                $empresa = '';
                $nombre = '';
                $url = '';
                $aux = $this->$tipo;
                //$aux = $this->segui;
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
            
            //$this->$segui = $complete;
            $this->$tipo = $complete;
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
                $aux = str_ireplace('{titulo_exp}', $valor->nombre, $aux);
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
//        public function refactory_gustaria($datos){            
        public function refactory_visitaria($datos){            

            
            $global = new Global_var();
            $url = $global->url_sitio;
            $quiere = "";
            
            foreach ($datos as $valor){
                $aux = $this->gustaria;
                $aux = str_ireplace('{imagen}', $valor->imagen, $aux);
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
            
            /********EVITO QUE SE REPITAN AMIGOS***********/
            $pos_repetidos = array();         

            array_multisort($datos, SORT_ASC); //ordeno los datos de menor a mayor segun su ID            

//                //busca la posicion de los ids repetidos
            for($i=1;count($datos)-1>$i;$i++){
                if($datos[$i]->id==$datos[$i-1]->id){
                    array_push($pos_repetidos, $i);
                }                              
            }   

            //elimina los elementos repetidos de la lista
            for($i=0;count($pos_repetidos)>$i;$i++){
                unset($datos[$pos_repetidos[$i]]);  
            }    
                
            
            $amigos = "";            
            
            for($c=0; count($datos); $c++){                
                
                $amigos .= '<div class="row-fluid">';                            
                $i=0;
                do{ 
                    $valor=array_shift($datos);
                   
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
                    $amigos .= $aux;
                    $i++;
                }while((count($datos)!=0)&& $i<3);                
                
                $amigos .= '</div>';
            }            
            
            $this->amigos = $amigos;
            $this->actualizar_diccionarios();

        }


        
//        public function refactory_AmigosDeAmigos($datos){
//            
//            $complete = "";            
//            
//            foreach ($datos as $valor){
//                $global = new Global_var();
//                $empresa = '';
//                $nombre = '';
//                $url = '';
//                $aux = $this->amigos;
//                //echo $valor->type;
//                if($valor->type == "Empresa"){                                    	         
//                    $empresa = 'style="background-color: #CBFEC1"';
//                    $nombre = $valor->nombre;
//                    $url = $global->url_empresa;
//                }else{
//                    //$nombre = $valor->nick;
//                    $nombre = $valor->nombre." ".$valor->apellido;
//                    $url = $global->url_usuario;
//                }            
//                $aux = str_ireplace('{empresa}', $empresa, $aux);            
//                $aux = str_ireplace('{id}', $valor->id, $aux);
//                $aux = str_ireplace('{url}', $url, $aux);
//                $aux = str_ireplace('{imagen}', $valor->imagen, $aux);
//                $aux = str_ireplace('{nombre}', $nombre, $aux);
//                //$aux = str_ireplace('{amigo}', $amigo, $aux);
//                $complete .= $aux;
//            }
//            
//            $this->amigos = $complete;
//            $this->actualizar_diccionarios();
//
//        }
  
      

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
