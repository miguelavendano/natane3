<?php

    require_once '../../core/global_var.php';

    class GaleriaVista{
        
        public $base;        
        public $head;        
        public $modal;
        public $links;
        public $metas;
        public $script;
        
        public $galeria;
        public $fotos;   
        public $albun;
        
        public $dic_galeria;
        public $dic_base;
        
        
        public function __construct() {
            
            $this->base = file_get_contents('../../plantillas/generales/base.html');            
            $this->head = file_get_contents('../../plantillas/generales/head.html');     
            $this->modal = file_get_contents('../../plantillas/generales/barraModal.html');            
            $this->galeria = file_get_contents('../../plantillas/galeria/galeria.html');
            $this->fotos = file_get_contents('../../plantillas/galeria/fotosGaleria.html');
            $this->albun = file_get_contents('../../plantillas/galeria/albun.html');

            
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
                        <script src="{JS}/scripts.js"></script>
                        <script>
                          $(document).ready(function(){
                           $('.'"#gallery-container").sGallery({
                              fullScreenEnabled: true
                            });
                          });
                        </script> ';
            
            
            
            
            
            $this->dic_base = array('metas'=>$this->metas,
                                'links'=>$this->links,
                                'script' => $this->script,
                                'head'=>$this->head,
                                'contenido'=>$this->galeria);     
            
            $this->dic_galeria = array('fotos'=>  $this->fotos,
                                    'modales'=>  $this->modal);              
            
            
        }
        
        
        
        public function actualizar_diccionarios(){
            
            $this->dic_base = array('metas'=>$this->metas,
                                'links'=>$this->links,
                                'script'=> $this->script,
                                'head'=>$this->head,
                                'contenido'=>$this->galeria);
            
            $this->dic_galeria = array('fotos'=>  $this->fotos,
                                    'modales'=>  $this->modal);
            
            
            
            
        }
        
        
        /**
         * Funcion que refactoriza el header dependiendo del tipo de usuario que lo 
         * esta accediendo.
         */
        public function refactory_header($opcion){
            

            $this->head = Global_var::refactory_header($opcion, false); 
    
        }              
        
        
        
        public function refactory_galeria($id, $url_padre, $nombre_galeria){
            
            $this->galeria = str_ireplace("{url_padre}", $url_padre, $this->galeria);
            $this->galeria = str_ireplace("{id}", $id, $this->galeria);
            $this->galeria = str_ireplace("{nombre_galeria}", $nombre_galeria, $this->galeria);
            
        }
        
        
        public function refactory_fotos($datos){            
            
            $resultados="";
            $fotos = $this->fotos;
            
            for($c=0; count($datos); $c++){
                
                $resultados .= '<div class="row-fluid">';                            
                $i=0;
                do{ 
                    $sitio=array_shift($datos);
                    $aux = $fotos;
                    
                    if($sitio['type']=="Usuario")
                        $aux = str_ireplace("{url_autor}", "{url_usuario}", $aux);
                    else
                        $aux = str_ireplace("{url_autor}", "{url_empresa}", $aux);
                    
                    $aux = str_ireplace("{url_img}", "{url_imagen}", $aux);
                    $aux = str_ireplace("{id_imagen}", $sitio['img_id'], $aux);
                    $aux = str_ireplace("{imagen}", $sitio['img_nombre'], $aux);  
                    $aux = str_ireplace("{id_usuario}", $sitio['usuario_id'], $aux);
                    $aux = str_ireplace("{nombre_usuario}", $sitio['usuario_nick'], $aux);
                    $aux = str_ireplace("{img_usuario}", $sitio['usuario_img'], $aux);  
                    
                    $resultados .= $aux;
                    $i++;
                }while((count($datos)!=0)&& $i<4);

                $resultados .= '</div>';
            }
            
            
            
            $this->fotos = $resultados;
            $this->actualizar_diccionarios();
            
//                    'img_nombre'=>$img['']->getProperty('nombre'), 
//                    'img_id'=>$img['']->getId(), 
//                    'usuario_img'=>$usuario[0]->getProperty('imagen'), 
//                    'usuario_nick'=>$usuario[0]->getProperty('nick'), 
//                    'usuario_id'=>$usuario[0]->getId());            
            
        }
        
       
//        public function refactory_albun(){
//
//            $fotos_small = str_ireplace("{tamano}", "small", $this->fotos);
//            $fotos_small = str_ireplace("{tam_foto_big}", "", $fotos_small );
//            
//            $fotos_big = str_ireplace("{tamano}", "big", $this->fotos);
//            $fotos_big = str_ireplace("{tam_foto_big}", "--big", $fotos_big );            
//            
//            
//            $this->albun = str_ireplace("{foto_small}", $fotos_small , $this->albun);
//            $this->albun = str_ireplace("{foto_big}", $fotos_big , $this->albun);
//                       
//            
//            $this->actualizar_diccionarios();
//            
//        }
        
        
        public function refactory_resultados_total(){
            
            $globales = new Global_var();
            
            
            foreach($this->dic_galeria as $clave=>$valor){
               
                $this->galeria = str_ireplace('{'.$clave.'}', $valor, $this->galeria);
                
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
