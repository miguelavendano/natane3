<?php
    
    require_once('../../core/modeloAdministrador.php');    
    require_once('../../core/modeloPublicacion.php');    
    require_once('../../librerias/neo4jphp.phar');
    require_once('../../librerias/Neo4Play.php');    
    

    
    /**
     * Clase controlador de la interacción con la base de datos del modulo de administrador.
     */
    class AdministradorModel{
        
        /**
         *Instancia de la clase ModelAdministrador.
         * @var ModelAdministrador  
         */
        public $modeladministrador;
        
        /**
         *Instancia de la clase ModelPublicacion
         * @var ModelPublicacion 
         */
        public $modelpublicacion;
        
        /**
         *Id del usuario administrador.
         * @var int 
         */
        public $id_user;
        
        
        /**
         * Metodo Constructor donde se inicializan los atribudos de la clase
         * @param String $id Id del Administrador a mostrar.
         */
        public function __construct($id) {
            
            $this->modeladministrador = new ModelAdministrador();
            $this->modelpublicacion = new ModelPublicacion();
            $this->id_user = $id;
            
        }       
        
        
        /**
         * Construye la consulta para retornar los datos del administrador.
         * @return Array 
         */
        public function get_admin(){   
                        
            $query = "START n=node(".$this->id_user.") RETURN n";            
            $resultado = $this->modeladministrador->get_administrador($query);

            return $resultado;            
        }  
        
        /**
         * Construye la consulta para retornar los datos de los usuarios mas populares.
         * @return Array
         */
        public function get_populares(){   
                        
            $query = "START n=node(*) WHERE n.type='Usuario' RETURN n limit 50";            
            $filtro = "MATCH n<-[:Amigo]-a RETURN count(a) as seguidores";
            $resultado = $this->modeladministrador->get_usuariosVistaAdmin($query,$filtro);

            return $resultado;            
        } 
        
        /**
         * Construye la consulta que trae las ultimas experiencias compartidas por los usuarios
         * @return Array
         */
        public function get_comparten(){   
                        
            $query = "START n=node(*) WHERE n.type='Usuario' RETURN n limit 50";            
            $filtro = "MATCH n-[:Comparte]->e RETURN count(e) as experiencias";
            $resultado = $this->modeladministrador->get_usuariosVistaAdmin($query,$filtro);

            return $resultado;            
        }         
        
        
        
        /**
         * Construye la consulta que trae las ultimas noticias publicadas por el administrador
         * @return array
         */
        public function get_noticias(){   

            $query = "START n=node(".$this->id_user.") MATCH n-[:Informa]->b WHERE b.type?='Noticia' return b ORDER BY b.fecha DESC";            
            $resultado = $this->modelpublicacion->get_noticias($query);

            return $resultado;            
        }          
           
        
        /**
         * Construye la consulta que trae los ultimos eventos publicados por el administrador.
         * @return Array
         */
        public function get_eventos(){   
                        
            $query = "START n=node(".$this->id_user.") MATCH n-[:Informa]->b WHERE b.type?='Evento' return b ORDER BY b.fecha DESC";            
            $resultado = $this->modelpublicacion->get_eventos($query);

            return $resultado;            
        }                  
        
    }