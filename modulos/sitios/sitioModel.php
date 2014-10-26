<?php
    
    require_once('../../core/modeloSitio.php');   
    require_once('../../core/modeloUsuario.php'); 
    require_once('../../core/modeloExperiencia.php');    
    require_once('../../librerias/neo4jphp.phar');
    require_once('../../librerias/Neo4Play.php');    
    

    /**
     * Clase controlador de la interacción con la base de datos del modulo Sitios.
     */
    class SitioModel{
        
        /**
         *Instancia de la Clase ModelSitios.
         * @var  ModelSitios
         */
        public $modelsitios;
        
        /**
         *Instancia de la Clase ModelUsuarios.
         * @var ModelUsuarios 
         */        
        public $modelusuario;
        
        /**
         *Instancia de la Clase ModelExperiencia.
         * @var ModelExperiencia 
         */                
        public $modelexpe;
        
        /**
         *Id del Sitio
         * @var String 
         */        
        public $id_sitio;
        
        
        /**
         * Metodo Constructor donde se inicializan los atribudos de la clase
         * @param String $id Id del sitio a mostrar.
         */
        public function __construct($id) {            
            $this->modelsitios = new ModelSitios();
            $this->modelusuario = new ModelUsuarios();
            $this->modelexpe = new ModelExperiencia();
            $this->id_sitio = $id;            
        }       
        
        /**
         * Construye la consulta para retornar los datos de contacto del Sitio.
         * @return Array
         */
        public function get_contacto(){
            
            $query = "START n=node(".$this->id_sitio.") RETURN n";            
            $resultado = $this->modelsitios->get_contacto($query);
            return $resultado;                        
            
        }
        
        /**
         * Construye la consulta para retornar las imagenes a mostrar en el Slider Principal.
         * @return Array 
         */             
        public function get_slider(){
            
            $query = "START n=node(".$this->id_sitio.") MATCH n<-[:Asociada]-e-[:Img]->i RETURN i.nombre";
            $imagenes = $this->modelsitios->get_img_slider($query);
            return $imagenes;
        }        

        /**
         * Construye la consulta para retornar la imagen principal del sitio.
         * @return Array 
         */            
        public function get_img_perfil(){
            
            return $this->modelsitios->get_img_perfil($this->id_sitio);
        }        
        
        
        /**
         * Construye la consulta para retornar los datos para el ferrocarril de disitios relacionados.
         * @return Array 
         */            
        public function get_ferrocarril(){

            $query = "START n=node(".$this->id_sitio.") MATCH n<-[:Semejantes]->b RETURN b limit 50;";
            
            $resultado = $this->modelsitios->get_semejantes($query);
            $resultado = array();
            if(count($resultado)<10){
                $query = "START n=node(*) WHERE n.type='Sitio' RETURN n limit 50;";
                $resultado2 = $this->modelsitios->get_sitio_aleatorio($query, 10 - count($resultado));
            }
            
            $final = array_merge($resultado, $resultado2);
            
            return $final;            
        }        
        

        /**
         * Construye la consulta para retornar los datos los usuarios que han visitado este sitio.
         * @return Array 
         */            
        public function get_visitantes(){   
            $query = "START n=node(".$this->id_sitio.") MATCH n<-[:Fan]-b RETURN b;";            
            $resultado = $this->modelusuario->get_visitantes($query);
            return $resultado;
        }          
        

        /**
         * Construye la consulta para retornar los datos los usuarios que les gustaría ir a este sitio.
         * @return Array 
         */              
        public function get_gustaria(){               
            $query = "START n=node(".$this->id_sitio.") MATCH n<-[:Desea]-b RETURN b;";            
            $resultado = $this->modelusuario->get_desean($query);
            return $resultado;            
        } 
                

        /**
         * Construye la consulta para retornar la experiencias publicadas por los usuarios.
         * @return Array 
         */          
        public function get_experiencias_visitantes(){   
                        
            $query = "start n=node(".$this->id_sitio.") match n<-[:Asociada|Etiqueta]->b return b;";            
            //$resultado = $this->modelexpe->get_exper_usuario($query);
            $resultado = $this->modelexpe->get_experiencias($query);
            

            return $resultado;            
        }                  
        /*
        public function get_coordenadas_mapa(){            
            $query = "START n=node(".$this->id_sitio.") RETURN n.latitud,n.longitud";
            $resultado = $this->modelsitios->get_property_mapa($query,"latitud","longitud");
            return $resultado;                        
        }      */   

    }