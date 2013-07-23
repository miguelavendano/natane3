<?php
    require_once('../core/coneccion.php');
    require_once('../core/Sitio.php');
    require_once '../core/global_var.php';
    
    class IndexVista{
        public $liks;
        public $metas;
        public $base;        
        public $plant_img;
        public $file;
        public $head;
        public $slider;
        public $ferro;
        public $elemento_ferro;
        public $modal;
        public $diccionario;
        public $diccionario2;
        public $img_principal;            
        public $img_secun;

        
        
        
        public function __construct() {
            
            $this->base = file_get_contents('../plantillas/generales/base.html');
            $this->file = file_get_contents('../plantillas/index/index.html');
            $this->head = file_get_contents('../plantillas/generales/head.html');    
            $this->slider = file_get_contents('../plantillas/index/slider.html');
            $this->ferro = file_get_contents('../plantillas/generales/ferrocarril.html');
            $this->elemento_ferro=file_get_contents('../plantillas/generales/elemento_ferro.html');
            $this->modal = file_get_contents('../plantillas/generales/barraModal.html');         
   	    $this->img_principal ='
	    <div class="item active">
		<img alt="Jaipur" src="{IMG_NATANE}/{url}" />
	    </div>';  	
            $this->img_secun ='
            <div class="item">
                <img alt="Jaipur" src="{IMG_NATANE}/{url}" />
            </div>';  
            
            $this->metas = '<meta charset="utf-8">';
            
            $this->links='
                <title> {TITULO} </title>
                <link href="{CSS}/bootstrap.css" rel="stylesheet">    
                <link href="{CSS}/bootstrap-responsive.css" rel="stylesheet">        
                <link href="{CSS}/estilos.css" rel="stylesheet">
                <link href="{CSS}/estilos_index.css" rel="stylesheet">
                <link href="{CSS}/estilos_modal.css" rel="stylesheet" />
                <link href="{CSS}/estilos_ferrocarril.css" rel="stylesheet">    
                <link href="{CSS}/datepicker.css" rel="stylesheet" />
                <link href="{CSS}/font-awesome.min.css" rel="stylesheet" />                            
            ';

        }
        
        public function actualizar_diccionary(){
            
            $this->diccionario = array('slider'=>$this->slider,  
                                'ferrocarril'=>$this->ferro,
                                'modales'=>$this->modal);   
         

            $this->diccionario2 = array('metas'=>$this->metas,
                                'links'=>$this->links,  
                                'head'=>$this->head,
                                'contenido'=>$this->file);                           
            
            
        }        


        public function refactory_slider(array $datos){   // contruye el slider
            
            $imagenes = str_ireplace("{url}", $datos[0], $this->img_principal); // carga la imagen principal del slider

            for($i=1; $i<count($datos); $i++){  // carga el resto de imagenes                             
                $imagenes .= str_ireplace("{url}", $datos[$i], $this->img_secun);
            }            
                        
            $this->slider = str_ireplace("{imagenes}", $imagenes, $this->slider);   // se remplazan todas las imagenes sobre el template de slider

        }
        
        public function refactory_ferrocarril(array $datos){  // contruye el ferrocarril
            
            $this->actualizar_diccionary();  // actualiza los valores del diccionarios de datos
            
            $elementos="";     // variable que construirá los elementos de ferrocarril
            $aux="";                        
            
            
            for ($i=0; $i<count($datos); $i++){   // construye los elementos del ferrocarril
                
                $aux = $this->elemento_ferro;                  
                $aux = str_ireplace("{id_sitio}", $datos[$i]->id, $aux);                
                $aux = str_ireplace("{icono}", "icon-music", $aux);                
                $aux = str_ireplace("{nombre}", $datos[$i]->nombre, $aux);                
                $aux = str_ireplace("{imagen}", $datos[$i]->imagen, $aux);                                              
                
                $elementos = $elementos.$aux;                 
                
                
            }
            
            // termina de ensamblar los elementos del ferrocarril con la estructura general del mismo            
            $this->ferro = str_ireplace("{contenido_ferro}", $elementos, $this->ferro);
            
        }            

        
        public function refactory_index(){ // construye el contenido del index          
            
           $this->actualizar_diccionary();
            foreach ($this->diccionario as $clave=>$valor){
                
                $this->file = str_ireplace('{'.$clave.'}', $valor, $this->file);
                
            }
        }
        
        
        public function refactory(){  // contruye todo insertando el contenido del index en la plantilla base
            
            $this->actualizar_diccionary();
            
            $globales = new Global_var();
            
            
            foreach($this->diccionario2 as $clave=>$valor){
                
                $this->base = str_ireplace('{'.$clave.'}', $valor, $this->base);

                
            }
            
            foreach ($globales->global_var as $clave => $valor){
                $this->base = str_ireplace('{'.$clave.'}', $valor, $this->base);
            }

            echo $this->base;          
            
        }
   

    }  

?>