<?php

    require_once '../../core/global_var.php';

    
    /**
     * Clase controlador de los elementos html5 utilizados en el modulo de consultas.
     */
    class ConsultaVista{
        
        /**
         *Variable que contiene el codigo html de la estructura
         * general del la interfaz grafica. (plantillas/generales/base.html)
         * @var String  
         */        
        private $base;
        
        /**
         *Variable que contiene el codigo html de la ventanas modales disponibles para esta interfaz. (plantillas/consulta/elemento_respuesta.html')
         * @var String  
         */                                
        private $elem_result;
        
        /**
         *Variable que contiene el codigo html de cada uno de los resultados de la consulta (plantillas/consulta/resultadoConsulta.html)
         * @var String  
         */                
        private $head;
        
        /**
         *Variable que contiene el codigo html donde seran mostrados los resultados de la consulta (plantillas/consulta/resultadoConsulta.html)
         * @var String 
         */
        private $resul;
        
        /**
         *Variable que contiene el codigo html de la ventanas modales disponibles para esta interfaz. plantillas/generales/barraModal.html
         * @var String  
         */                
        private $modal;
        
        /**
         *Variable que contiene el codigo html de las etiquetas "meta" utilizadas para esta interfaz
         * @var String  
         */                
        private $links;
        
        /**
         *Variable que contiene el codigo html de las etiquetas "script" utilizadas para esta interfaz
         * @var String  
         */                
        private $metas;
        
        /**
         *Variable diccionario general de las variables que poseen fracmentos html que generan el contenido de la interfaz grafica de la Consulta.
         * @var String  
         */                
        private $dic_consulta;
        
        /**
         *Variable diccionario general de las variables que contienen la estructura general de la interfaz grafica de consultas
         * 
         * @var String  
         */                      
        private $dic_base;
        
        /**
         *Variable que contiene el codigo html de las etiquetas "script" utilizadas para esta interfaz
         * @var String  
         */                
        public $script;
        
        
        
        /**
         * Constructor de la clase.
         * 
         * Inicializa la gran mayoria de atributos de la clase
         */        
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

        
        /**
         * Metodo encargado de actualizar los datos de los diccionarios
         * a medida que se van refactorizando y cambiando constantemente.
         * 
         */        
        public function actualizar_diccionarios(){
            
            $this->dic_consulta = array('resultado'=>$this->elem_result, 'modales'=>$this->modal);
            
            $this->dic_base = array('metas'=>$this->metas,
                                'links'=>$this->links,
                                'script' => $this->script,
                                'head'=>$this->head,
                                'contenido'=>$this->resul);      
        }
        
        
        /**
         * Funcion que refactoriza el header dependiendo del tipo de usuario que lo 
         * esta accediendo.
         */
        public function refactory_header($opcion){
            
            $this->head = Global_var::refactory_header($opcion, false);                                        
                    
        }
        
        
        
        /**
         * Refactoriza cada uno de los elementos consultados.
         * @param Array $datos Datos de los resultados de la consulta.
         */
        public function refactory_elementos($datos){            

            if($datos){
                $resultados="";
                $elemento = $this->elem_result;           


                for($c=0; count($datos); $c++){                

                    $resultados .= '<div class="row-fluid">';                            
                    $i=0;
                    do{ 
                        $resultado=array_shift($datos);
                        
                        if($resultado->type=="Sitio"){
                            $aux = $elemento;
                            $aux = str_ireplace("{url}", "{url_sitio}", $aux);
                            $aux = str_ireplace("{id_sitio}", $resultado->id, $aux);
                            $aux = str_ireplace("{nombre}", $resultado->nombre, $aux);
                            $aux = str_ireplace("{imagen}", $resultado->imagen, $aux);
                            $aux = str_ireplace("{icono}", $resultado->tipo_sitio, $aux);
                            $resultados .= $aux;
                        }
                        elseif($resultado->type=="Empresa"){
                            $aux = $elemento;
                            $aux = str_ireplace("{url}", "{url_empresa}", $aux);
                            $aux = str_ireplace("{id_sitio}", $resultado->id, $aux);
                            $aux = str_ireplace("{nombre}", $resultado->nombre, $aux);
                            $aux = str_ireplace("{imagen}", $resultado->imagen, $aux);
                            $aux = str_ireplace("{icono}", "", $aux);
                            $resultados .= $aux;                            
                        }
                        elseif($resultado->type=="Usuario"){
                            $nom = $resultado->nombre." ".$resultado->apellido;
                            $aux = $elemento;
                            $aux = str_ireplace("{url}", "{url_usuario}", $aux);
                            $aux = str_ireplace("{id_sitio}", $resultado->id, $aux);
                            $aux = str_ireplace("{nombre}", $nom, $aux);
                            $aux = str_ireplace("{imagen}", $resultado->imagen, $aux);
                            $aux = str_ireplace("{icono}", "", $aux);
                            $resultados .= $aux;
                        }
                        
                        $i++;                        
                    }while((count($datos)!=0) && $i<4 && $resultado->type="Empresa" || $resultado->type="Sitio" || $resultado->type="Usuario");

                    $resultados .= '</div>';
                }

                $this->elem_result = $resultados;
              
            }
            else { $this->elem_result = "<h2>NO se han encontrado coincidencias.</h2>"; }
        }
        

        /**
         * Refactoriza totalmente la interfaz grafica del modulo consultas con sus repectivos resultados.
         */
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
