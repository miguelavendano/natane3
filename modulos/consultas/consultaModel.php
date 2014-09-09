<?php   
    require_once('../../core/modeloNodos.php');
    require_once('../../librerias/neo4jphp.phar');
    require_once('../../librerias/Neo4Play.php');    
    

    /**
     * Clase controlador de la interacción con la base de datos del modulo de consultas.
     */
    class ConsultaModel{

        /**
         *Instancia de la clase ModelNodos.
         * @var ModelNodos  
         */
        public $modelnodos;
        
        /**
         *Se encuentra la consulta realizada por el usuariario.
         * @var String 
         */
        public $consulta;
        
        
        
        /**
         * Inicializa los atributos de la clase.
         * @param String $busqueda Consulta realizada por el usuario.
         */
        public function __construct($busqueda) {             
            $this->modelnodos = new ModelNodos();
            $this->consulta = $busqueda;
        }       
        
        
        /**
         * Construye la consulta que permite traer los posibles resultados a la consulta del usaurio
         * @return Array
         */
        public function get_resultados(){   

            //  $query = "START n=node(*) WHERE n.nombre =~ '(?i).*".$this->consulta.".*' AND (n.type='Usuario' OR n.type='Sitio' OR n.type='Empresa') RETURN n";            
            $query = "START n=node(*) WHERE n.type<>'Imagen' AND n.type<>'Experiencia' AND n.type<>'Servicio' AND n.type<>'Comentario' AND n.nombre =~ '(?i).*".$this->consulta.".*' RETURN n";
            
            $resultado = $this->modelnodos->get_todo($query);
            
            if($resultado){
                return $resultado;
            }
            else{ return; }
            
        }  
    }
        
?>
