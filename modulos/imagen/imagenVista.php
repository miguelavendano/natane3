<?php

    require_once '../../core/global_var.php';

    class ImagenVista{
        
        public $base;        
        public $head;        
        public $modal;
        public $links;
        public $metas;
        public $script;
        
        public $contenido;
        public $imagen;   
        public $comentarios;
        
        public $dic_galeria;
        public $dic_base;
        
        
        public function __construct() {
            
            $this->base = file_get_contents('../../plantillas/generales/base.html');            
            $this->head = file_get_contents('../../plantillas/generales/head.html');            
            $this->modal = file_get_contents('../../plantillas/generales/barraModal.html');            
            $this->contenido = file_get_contents('../../plantillas/imagen/imagen.html');
            $this->comentarios = file_get_contents('../../plantillas/imagen/comentarios.html');
            $this->imagen = file_get_contents('../../plantillas/imagen/img_usuario.html');


            
            $this->metas = '<meta charset="utf-8">
                            <title>{TITULO}</title>
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <meta name="description" content="">
                            <meta name="author" content="">';
            
            $this->links = '<link href="{CSS}/bootstrap.css" rel="stylesheet">
                        <link href="{CSS}/bootstrap-responsive.css" rel="stylesheet">
                        <link href="{CSS}/estilos.css" rel="stylesheet">    
                        <link href="{CSS}/estilos_mirar_fotos.css" rel="stylesheet">    
                        
                        <link href="{CSS}/estilos_modal.css" rel="stylesheet" />    
                        <link href="{CSS}/datepicker.css" rel="stylesheet" />
                        <link href="{CSS}/font-awesome.min.css" rel="stylesheet" />    
                        <link href="{CSS}/jquery.jscrollpane.css" rel="stylesheet" />                                    
                        <link rel="stylesheet" href="{CSS}/styles.css" />';            
            
            
            $this->script ='    
                        <script src="{JS}/jquery-1.8.2.min.js"></script>
                        <script src="{JS}/plugins.js"></script>
                        <script src="{JS}/scripts.js"></script>';
            
            
            
            
            
            $this->dic_base = array('metas'=>$this->metas,
                                'links'=>$this->links,
                                'script' => $this->script,
                                'head'=>$this->head,
                                'contenido'=>$this->contenido);     
            
            $this->dic_imagen = array('imagen'=>  $this->imagen,
                                    'comentarios'=>  $this->comentarios,
                                    'modales'=>  $this->modal);
            
            
        }
        
        
        
        public function actualizar_diccionarios(){
            
            $this->dic_base = array('metas'=>$this->metas,
                                'links'=>$this->links,
                                'script'=> $this->script,
                                'head'=>$this->head,
                                'contenido'=>$this->contenido);
            
            $this->dic_imagen = array('imagen'=>  $this->imagen,
                                    'comentarios'=>  $this->comentarios,
                                    'modales'=>  $this->modal);
            
            
        }
        
       
        
        public function refactory_imagen($datos){            
            
            $resultados="";
            $fotos = $this->imagen;
            
            for($c=0; count($datos); $c++){
                
                //$resultados .= '<div class="row-fluid">';                            
                //$i=0;
                //do{ 
                    $sitio=array_shift($datos);
                    $aux = $fotos;
                    
                    if($sitio['type']=="Usuario")
                        $aux = str_ireplace("{url_autor}", "{url_usuario}", $aux);
                    else
                        $aux = str_ireplace("{url_autor}", "{url_empresa}", $aux);
                    

                    $aux = str_ireplace("{id_imagen}", $sitio['img_id'], $aux);
                    $aux = str_ireplace("{imagen_galeria}", $sitio['img_nombre'], $aux);  
                    $aux = str_ireplace("{id_usuario}", $sitio['usuario_id'], $aux);
                    $aux = str_ireplace("{img_usuario}", $sitio['usuario_img'], $aux);  
                    $aux = str_ireplace("{nick_usuario}", $sitio['usuario_nick'], $aux);                      
                    
                    $resultados .= $aux;
                //    $i++;
                //}while((count($datos)!=0)&& $i<4);

                //$resultados .= '</div>';
            }
            
            $this->imagen = $resultados;
            $this->actualizar_diccionarios();
            
        }
        
        
        public function refactory_comentarios($datos){            
            
            $resultados="";
            $fotos = $this->comentarios;
            
            for($c=0; count($datos); $c++){
                
                //$resultados .= '<div class="row-fluid">';                            
                $i=0;
                do{ 
                    $sitio=array_shift($datos);
                    $aux = $fotos;
                    
                    if($sitio['type']=="Usuario")
                        $aux = str_ireplace("{url_usuario}", "{url_usuario}", $aux);
                    else
                        $aux = str_ireplace("{url_usuario}", "{url_empresa}", $aux);
                    
                    
                    $aux = str_ireplace("{id_comentario}", $sitio['id_comentario'], $aux);  
                    $aux = str_ireplace("{comentario}", $sitio['detalle'], $aux);  
                    $aux = str_ireplace("{fecha}", $sitio['fecha'], $aux);
                    $aux = str_ireplace("{id_usuario}", $sitio['id_usuario'], $aux);
                    $aux = str_ireplace("{img_usuario}", $sitio['img_usuario'], $aux);  
                    $aux = str_ireplace("{nick_usuario}", $sitio['nick_usuario'], $aux);                      
                    
                    $resultados .= $aux;
                    $i++;
                }while((count($datos)!=0)&& $i<4);

                //$resultados .= '</div>';
            }
            
            $this->comentarios = $resultados;
            $this->actualizar_diccionarios();
            
        }
        
        
        public function refactory_total(){
            
            $globales = new Global_var();
            
            
            foreach($this->dic_imagen as $clave=>$valor){               
                $this->contenido = str_ireplace('{'.$clave.'}', $valor, $this->contenido);                
            }           
            
            $this->actualizar_diccionarios();
            
            foreach ($this->dic_base as $clave=>$valor){                    
                $this->base = str_ireplace('{'.$clave.'}', $valor, $this->base);                
            }
            
            foreach ($globales->global_var as $clave => $valor){
                $this->base = str_ireplace('{'.$clave.'}', $valor, $this->base);
            }            
            
            
            echo $this->base;
            
            
        }
        

    }
        
?>
