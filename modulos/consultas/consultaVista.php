<?php

    require_once '../../core/global_var.php';

    class ConsultaVista{
        
        private $base;
        private $elem_result;
        private $head;
        private $resul;
        private $modal;
        private $links;
        private $metas;
        private $dic_consulta;
        private $dic_base;
        public $script;
        
        
        public function __construct() {
            
            $this->base = file_get_contents('../../plantillas/generales/base.html');
            $this->elem_result = file_get_contents('../../plantillas/consulta/elemento_respuesta.html');
            $this->head = file_get_contents('../../plantillas/generales/head.html');
            $this->resul = file_get_contents('../../plantillas/consulta/resultadoConsulta.html');
            $this->modal = file_get_contents('../../plantillas/generales/barraModal.html');                        
            $this->metas = '<meta charset="utf-8">
                            <title>{TITULO}</title>
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">                            
                            <meta name="description" content="">
                            <meta name="author" content="">';
            
            $this->links='  <link href="{CSS}/bootstrap.css" rel="stylesheet">
                            <link href="{CSS}/bootstrap-responsive.css" rel="stylesheet">
                            <link href="{CSS}/estilos.css" rel="stylesheet">    
                            <link href="{CSS}/estilos_resultado_busqueda.css" rel="stylesheet">    
                            <link href="{CSS}/estilos_modal.css" rel="stylesheet" />
                            <link href="{CSS}/datepicker.css" rel="stylesheet" />
                            <link href="{CSS}/font-awesome.min.css" rel="stylesheet" />    
                            <link href="{CSS}/jquery.jscrollpane.css" rel="stylesheet" />';            
            
            $this->script = "";
            
            $this->dic_consulta = array('resultado'=>$this->elem_result, 'modales'=>$this->modal);
            
            $this->dic_base = array('metas'=>$this->metas,
                                'links'=>$this->links,
                                'script' => $this->script,
                                'head'=>$this->head,
                                'contenido'=>$this->resul);            
            
            
        }
        
        public function actualizar_diccionarios(){
            
            $this->dic_consulta = array('resultado'=>$this->elem_result, 'modales'=>$this->modal);
            
            $this->dic_base = array('metas'=>$this->metas,
                                'links'=>$this->links,
                                'script' => $this->script,
                                'head'=>$this->head,
                                'contenido'=>$this->resul);      
        }
        
        
        public function refactory_elementos($datos){            

                $resultados="";
                $elemento = $this->elem_result;           


                for($c=0; count($datos); $c++){                

                    $resultados .= '<div class="row-fluid">';                            
                    $i=0;
                    do{ 
                        $resultado=array_shift($datos);
                        $aux = $elemento;
                        $aux = str_ireplace("{id_sitio}", $resultado->id, $aux);
                        $aux = str_ireplace("{nombre}", $resultado->nombre, $aux);
                        $aux = str_ireplace("{imagen}", $resultado->imagen, $aux);
                        $aux = str_ireplace("{icono}", $resultado->tipo_sitio, $aux);
                        $resultados .= $aux;
                        $i++;
                    }while((count($datos)!=0) && $i<4 && $resultado->type="Empresa" || $resultado->type="Sitio" || $resultado->type="Usuario");

                    $resultados .= '</div>';
                }

                $this->elem_result = $resultados;
    //            
    //                $sitio = new Sitio();
    //                $sitio->id = $row['']->getId();
    //                $sitio->nombre = $row['']->getProperty('nombre');
    //                $sitio->descripcion = $row['']->getProperty('descripcion');
    //                $sitio->tipo = $row['']->getProperty('tipo');
    //                $sitio->imagen = $row['']->getProperty('imagen');            

        }
        
        
        public function refactory_resultados_total(){
            
            $this->actualizar_diccionarios();
            $globales = new Global_var();
            
            
            foreach($this->dic_consulta as $clave=>$valor){
                $this->resul = str_ireplace('{'.$clave.'}', $valor, $this->resul);                
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
