<?php

    require_once 'global_var_model.php';

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
        public $url_login;
        
        
        
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

        
        
        public static function refactory_header($index){

            if($index){
                $head = file_get_contents('../plantillas/generales/headLogin.html');
                $headusuario = file_get_contents('../plantillas/generales/headUsuario.html');
                
            }else{
                $head = file_get_contents('../../plantillas/generales/headLogin.html');
                $headusuario = file_get_contents('../../plantillas/generales/headUsuario.html');
            }
            
            
            $empresashtml = 
                    '<li>
                        <a href="{url_empresa}?id={id_empresa}" class="cursor_link" id="BeditarU">
                            <img style="margin-left:20px; width: 20px; height: 20px;" src="{IMG_NATANE}/{img_empresa}">
                            {nombre_empresa}
                        </a>
                    </li>';            
            
            
            $sitioshtml = '            
                    <li>
                        <a href="{url_sitio}?id={id_sitio}" class="cursor_link" id="BeditarU">
                            <img style="margin-left:20px; width: 20px; height: 20px;" src="{IMG_NATANE}/{img_sitio}">
                            {nombre_sitio}
                        </a>
                    </li>';
            

            $todos_sitios ="";
            $todas_empresas ="";

            
            if($_SESSION['sitios']){          
                
                
                
                foreach ($_SESSION['sitios'] as $valor){                    
                
                    $auxsitio = $sitioshtml;
                    $auxsitio = str_ireplace('{id_sitio}',$valor['id'],$auxsitio);                    
                    $auxsitio = str_ireplace('{img_sitio}',$valor['imagen'],$auxsitio);                    
                    $auxsitio = str_ireplace('{nombre_sitio}',$valor['nombre'],$auxsitio);
                    
                    $todos_sitios .= $auxsitio;                    
                    
                }
            }
            
            
            
            
            if($_SESSION['empresas']){

                foreach ($_SESSION['empresas'] as $valor){                    
                
                    $auxempresa = $empresashtml;
                    $auxempresa = str_ireplace('{id_empresa}',$valor['id'],$auxempresa);
                    $auxempresa = str_ireplace('{img_empresa}',$valor['imagen'],$auxempresa);
                    $auxempresa = str_ireplace('{nombre_empresa}',$valor['nombre'],$auxempresa);                   
                    
                    $todas_empresas .= $auxempresa;
                    
                    
                }                
                
            }
            
            
            /*Refactorizar el login */
            
            $headusuario = str_ireplace('{lista_mis_sitios}',$todos_sitios,$headusuario);
            $headusuario = str_ireplace('{lista_mis_empresas}',$todas_empresas,$headusuario);         
            $headusuario = str_ireplace('{nick}',$_SESSION['nick'],$headusuario);         
            $headusuario = str_ireplace('{img_user}',$_SESSION['img'],$headusuario);     
            $headusuario = str_ireplace('{id_user}',$_SESSION['id'],$headusuario);     
            
            $head = str_ireplace('{opciones_login}',$headusuario,$head);

            
            return $head;
            
            
        }
        
        
        
        
    }





?>
