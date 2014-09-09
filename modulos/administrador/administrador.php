<?php 
    require_once 'administradorVista.php';    
    require_once 'administradorModel.php';
    require_once '../../core/Validar.php';
    require_once '../login/loginControl.php';

    
    /**
     * Clase controlador principal del modulo administrador
     */
    class Administradores{

        /**
         *Instancia de la clase vista.
         * @var AdministradorVista
         */
        public $vista;
        /**
         *Instancia de la clase Modelo
         * @var AdministradorModel
         */
        public $modelo;
                        
        
        /**
         * Constructor de la clase.
         * 
         * Inicializa los atributos de la clase
         * @param int $id Id del nodo administrador
         * 
         */
        public function __construct($id) {            
            $this->vista = new AdministradorVista($id);
            $this->modelo = new administradorModel($id);
        }       
        
        /**
         * Ejecuta el metodo get_admin() de la clase modelo
         * 
         * @return Array Los datos del administrador
         */
        public function datos_administrador(){
            $usuario = $this->modelo->get_admin();            
            return $usuario;            
        }

        /**
         * Ejecuta el metodo get_populares de la clase modelo
         * @return Array  Datos de los usuarios con mayor numero de seguidores
         */
        public function populares(){            
            return $this->modelo->get_populares();            
        }
        
        /**
         * Ejecuta el metodo get_comparten de la clase modelo
         * @return Array Datos de los usuarios que han compartido experiencias.
         */
        public function comparten(){            
            return $this->modelo->get_comparten();            
        }
        
        /**
         * Ejecuta el metodo get_noticias de la clase modelo
         * @return Array Datos de las noticias publicadas.
         */
        public function noticias(){            
            return $this->modelo->get_noticias();            
        }

        /**
         * Ejecuta el metodo get_eventos de la clase modelo
         * @return Array Datos de los eventos publicados 
         */
        public function eventos(){            
            return $this->modelo->get_eventos();            
        }        

        public function principal_Nousuario(){
            
        }        
        
        public function principal_Nologin(){
            
        }       
              
        
        
        /**
         * Metodo principal que organiza y estructura el controlador.
         * 
         * @param int $login valor numerico que si existe una sesión iniciada. 1 si esta logueado y 0 si no lo esta.
         */
        public function principal_administrador($login){
            
            $this->vista->refactory_header($login); 
            $this->vista->refactory_administrador($this->datos_administrador());          
            $this->vista->refactory_usuariosAdmin($this->populares(),"populares");
            $this->vista->refactory_usuariosAdmin($this->comparten(),"comparten");
            $this->vista->refactory_noticias($this->noticias());
            $this->vista->refactory_eventos($this->eventos());          
            $this->vista->refactory_contenido();
            $this->vista->refactory_total();
            
        }
    }

    
    
    $id = $_GET['id'];

    $validar = new Validar();

    if($validar->validar_id($id, "Administrador")){    // el id del nodo corresponde a un Administrador ?

        $admin = new Administradores($id);
        
        if(isset($_SESSION['id'])){ // existe sesion ?
            
            $admin->principal_administrador(true);                
        
        }else{
            
            header('Location: /natane3/Index/');
        }

    }
    

?>
