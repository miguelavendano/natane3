<?php
    
    require_once('../../core/modeloEmpresa.php');    
    require_once('../../librerias/neo4jphp.phar');
    require_once('../../librerias/Neo4Play.php');    
    require_once('../../core/modeloSitio.php');  
    require_once('../../core/modeloExperiencia.php');  
    
    
    /**
     * Clase controlador de la interacción con la base de datos del modulo Empresa.
     */
    class EmpresaModel{
        
        /**
         *Instancia de la Clase ModelEmpresa.
         * @var  ModelEmpresa
         */
        public $modelempresas;
        
        /**
         *Instancia de la Clase ModelSitios.
         * @var ModelSitios 
         */
        public $modelemsitios;
        
        /**
         *Instancia de la Clase ModelExperiencia
         * @var ModelExperiencia 
         */
        public $modelexpe;
        
        /**
         *Id de la Empresa.
         * @var String 
         */
        public $id_empresa;
        
        
        /**
         * Metodo Constructor donde se inicializan los atribudos de la clase
         * @param String $id Id de la empresa a mostrar.
         */
        public function __construct($id) {
            $this->modelempresas = new ModelEmpresa();
            $this->modelemsitios = new ModelSitios();
            $this->modelexpe = new ModelExperiencia();
            $this->id_empresa= $id;
        }       
        
        /**
         * Construye la consulta para retornar los datos de contacto de la Empresa.
         * @return Array 
         */
        public function get_contacto(){
            $query = "START n=node(".$this->id_empresa.") RETURN n";            
            $resultado = $this->modelempresas->get_contacto($query);
            return $resultado;
        }
        
        /**
         * Construye la consulta para retornar las imagenes a mostrar en el Slider Principal.
         * @return Array 
         */        
        public function  get_slider(){
            //$eslaider = array("panoramica1.jpg","panoramica4.jpg","panoramica3.jpg");
            $eslaider = array("165_18959_1_finca.jpg","165_19582_1_convivencia.jpg","165_16731_1_campamento.jpg");            
            return $eslaider;      
        }        

        /**
         * Construye la consulta para retornar los datos para el ferrocarril de disitios relacionados.
         * @return Array 
         */        
        public function get_ferrocarril(){
            $query = "START n=node(*) WHERE n.type='Sitio' RETURN n limit 50;";
            $resultado = $this->modelemsitios->get_sitio_aleatorio($query, 10);
            return $resultado;     
        }        
        
        
        /**
         * Construye la consulta para retornar los datos de los usuarios amigos de la Empresa.
         * @return Array 
         */
        public function get_amigos(){   
            //$query = "START n=node(".$this->id_empresa.") MATCH n-[:Amigo]->b RETURN b";
            $query = "START n=node(".$this->id_empresa.") MATCH n<-[:Cliente]-b RETURN b";
            $resultado = $this->modelempresas->get_amigos($query);
            return $resultado;
        }          
        
        /**
         * Construye la consulta para retornar los datos de los clientes y aliados de la empresa.
         * @return Array 
         */        
        public function get_clientes_aliados(){   
            //$query = "start n=node(".$this->id_empresa.") match n<-[:Partner|Cliente]->b return b";            
            $query = "start n=node(".$this->id_empresa.") match n<-[:Partner]->b return b";            
            $resultado = $this->modelempresas->get_clientes_aliados($query);
            return $resultado;            
        }                    
        
        /**
         * Construye la consulta para retornar los datos de los servicios que ofrece la empresa.
         * @return Array 
         */        
        public function get_servicios(){   
            $query = "start n=node(".$this->id_empresa.") match n-[:Ofrece]->b return b";
            $resultado = $this->modelempresas->get_servicios($query);            
            return $resultado;            
        }   
        
        /**
         * Construye la consulta para retornar la experiencias publicadas por la empresa.
         * @return Array 
         */        
        public function get_experiencias(){             
            $query = "START n=node(".$this->id_empresa.") match n<-[:Comparte|Etiqueta]->b return b;";            
            $resultado = $this->modelexpe->get_experiencias($query);
            return $resultado;            
        }                  
        
        /**
         * Construye la consulta para retornar las coordenadas de la ubicación geografica de la empresa.
         * @return Array 
         */
        public function get_coordenadas_mapa(){            
            $query = "START n=node(".$this->id_empresa.") RETURN n";
            //$resultado = $this->modelsitios->get_property_mapa($query);
            $resultado = $this->modelempresas->get_empresa($query);
            return $resultado;                        
        } 
        
                  
    }