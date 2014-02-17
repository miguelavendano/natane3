<?php

    require_once('../../core/modeloUsuario.php');
    require_once '../../core/modeloEmpresa.php';
    require_once '../../core/modeloSitio.php';    
    require_once('../../core/ConexionMysql.php');
    require_once('../../librerias/neo4jphp.phar');
    require_once('../../librerias/Neo4Play.php');    
    
    
    class LoginModel{
        
        public $modelusuario;
        public $modeloSitio;
        public $modeloEmpresa;
        public $Conexion;
             
        
        public function __construct() {
                    
            $this->modelusuario = new ModelUsuarios();
            $this->Conexion = new Conexion();
            
            $this->modeloEmpresa = new ModelEmpresa();
            $this->modeloSitio = new ModelSitios();
            
        }
        
        
        public function get_sitios($id_user){
            
            $cyper = "start n=node(".$id_user.") match n-[:Publica]->s return id(s) as id, s.nombre as nombre, s.imagen as imagen;";
            
            return $this->modeloSitio->get_sitios_usuario($id_user, $cyper);
            
        }        
        
        
        
        public function get_empresas($id_user){
            
            $cyper = "start n=node(".$id_user.") match n-[:Crea]->e return id(e) as id, e.nombre as nombre, e.imagen as imagen;";            
            
            return $this->modeloEmpresa->get_empresa_usuario($id_user, $cyper);
            
        }        
        
        
        
        /*
         * Realizar registro de usuario tanto en 
         * neo4j como en mysql
         */      
        
        public function registrar_usuario($nombre,$apellido,$genero,$fecha_nacimiento,$correo,$imagen,$contraseña, $type){
            
            
            $nodo_usuario = new Usuario();
            $mysql = new Conexion();

            $nodo_usuario->nombre = $nombre;
            $nodo_usuario->apellido = $apellido;            
            $nodo_usuario->genero = $genero;
            $nodo_usuario->fecha_nacimiento = $fecha_nacimiento;
            $nodo_usuario->correo = $correo;    
            $nodo_usuario->imagen = $imagen;   
            $nodo_usuario->contraseña = $contraseña;
            $nodo_usuario->type = $type;
            
            /*   aun no esta funcionando esto
	            $nodo_usuario->nick = $nik;
	            $nodo_usuario->ciudad_origen = $orig;
	            $nodo_usuario->lugar_recidencia = $reci;            
	            $nodo_usuario->sitio_web = $web;    
	            $nodo_usuario->facebook = $face;
	            $nodo_usuario->twitter = $twit;
	            $nodo_usuario->youtube = $you;
            */              
            
            ModelUsuarios::crearNodoUsuario($nodo_usuario); //crea el nodo del Usuario 

            $idneo4j = $nodo_usuario->id;  //obtengo el id del nodo creado
          

            /*
             * Registro de usuario en Mysql
             * "la url de facebook es importante y no se esta capturando"
             */
            
            $sql = "INSERT INTO usuario (
                        email,
                        idfacebook,
                        idneo4j,
                        password
                    )VALUES(
                        '".$correo."',
                        '12345678',
                        '".$idneo4j."',
                        '".$contraseña."'
                    );";
            
            return $mysql->ejecutar_query($sql);           
            
            
            
            
        }
        
        
        /*
         * Comprueba si existee usuario en la base de datos Mysql
         * Retorna email y password. o false si no existe.
         */
        
        public function existe_usuario($user){      
            
            
            $query = "SELECT email, password, idneo4j FROM usuario WHERE email = '".$user."';";
            $mysql = new Conexion();
            $resultado = $mysql->get_resultados_query($query);
            
            //print_r($resultado);
            
            if(!empty($resultado))
                return $resultado;
            
            return false;
                
            
        }
        
        /**
         * Trae datos de session importantes para el funcionamiento optimo de natane
         * @param string $id_usuario El id de usuario neo4j
         * @return array con los datos necesarios para iniciar variables de
         * session como tipo, cant empresas creadas, cant de sitios creados, nick
         */       
        
        public function get_inicio_session($id_usaurio){
            
            $query = "start a=node(".$id_usaurio.") return a.type as tipoUser, a.nick as nick, a.imagen as img";
            
            return $this->modelusuario->get_datos_session($query, $id_usaurio);
                        
        }
        
        
        
        /*
         * Traer contraseña de un usuario
         */        
        public function get_pass($id_user){         
            
            return $this->modelusuario->get_pass($id_user);
            

        }        
        
        
    }
    




?>

