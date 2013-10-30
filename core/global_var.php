<?php

    class Global_var{
        
        public $IMG_SYS;
        public $IMG_NATANE;
        public $CSS;
        public $JS;         
        public $global_var;
        public $TITULO;
        public $url_usuario;
        public $url_sitio;
        public $url_empresa;
        public $url_consulta;
        public $url_galeria;
        public $URL_INICIO;
        
        
        public function __construct() {
            $this->IMG_SYS = '/natane3/estatico/img';                            
            $this->IMG_NATANE = '/natane3/estatico/imagenes';
            $this->CSS = '/natane3/estatico/css';
            $this->JS = '/natane3/estatico/js';
            $this->TITULO = "Natane Turismo";
            $this->url_usuario = '/natane3/modulos/usuarios/usuario.php';
            $this->url_sitio = '/natane3/modulos/sitios/sitio.php';
            $this->url_empresa = '/natane3/modulos/empresas/empresa.php';
            $this->url_consulta = '/natane3/modulos/consultas/consulta.php';
            $this->URL_INICIO = '/natane3/Index/';
            $this->url_galeria= '/natane3/modulos/galeria/galeria.php';
            $this->url_login= '/natane3/modulos/login/login.php';
            
            
            


            $this->global_var = array('IMG_SYS'=>$this->IMG_SYS,'IMG_NATANE'=> $this->IMG_NATANE,
                                    'CSS'=>$this->CSS, 'JS'=>$this->JS, 'TITULO' => $this->TITULO,
                                    'url_usuario'=>$this->url_usuario, 'url_sitio'=>$this->url_sitio, 
                                    'url_empresa'=>$this->url_empresa, 'URL_INICIO'=>$this->URL_INICIO,
                                    'url_consulta'=>$this->url_consulta,
                                    'url_galeria'=>$this->url_galeria,
                                    'url_login'=>$this->url_login);            
            
            
        }
        
    }





?>
