<?php 
    require_once 'loginVista.php';    
    require_once 'loginModel.php';
    require_once '../../core/global_var.php';
    require_once '../../core/Validar.php';

    session_start();
    
    class Login{

        public $vista;
        public $modelo;        
        
        
        public function __construct() {            
            $this->vista = new LoginVista();
            $this->modelo = new LoginModel();
        }              
        

    /*
     * En esta sección se realiza validaciones del loguin
     * Verficamos si esta logueado, si el perfil pertenese a la personal logueada
     * y si no esta loqueado restingimos la informaciòn a mostrar por seguiridad de
     * la misma
     */
        
        
        /**
         * Funcion estatica donde verificamos si el usuario logueado 
         * es el dueño de un perfil de usuario determinado.
         * 
         * Lo que hace es una comparacion entre el id de sesion y el id del perfil.
         * 
         * @param stirng $idperfil Es el id del perfil al que se esta tratando de acceder.
         * @return bool retorna true si es el dueño y false si no.
         */
        public static function acceso_Pusuario($idperfil){
            
            if(isset($_SESSION['id']))
                if($_SESSION['id']==$idperfil)
                    return true;
                
            return false;
        }
        
        
        /**
         * Funcion estatica donde verificamos si el usuario logueado 
         * es el dueño de un sitio determinado.
         * 
         * Lo que hace es una comparacion entre los id's de sitios del usuario y el del sitio al que se quiere acceder
         * 
         * @param stirng $idSitio Es el id del sitio al que se esta tratando de acceder.
         * @return bool retorna true si es el dueño y false si no.
         */
        public static function acceso_Susuario($idSitio){
            
            if(isset($_SESSION['id'])){                
                foreach($_SESSION['sitios'] as $valor)                
                    if($valor['id']==  $idSitio)
                        return true;
            }
                
            return false;
        }        
        
        
        
        
        /**
         * Funcion estatica donde verificamos si el usuario logueado 
         * es el dueño de una empresa determinada.
         * 
         * Lo que hace es una comparacion entre los id's de empresas del usuario y el id de la empresa a la que se quiere acceder
         * 
         * @param stirng $idEmpresa Es el id de la empresa a la que se esta tratando de acceder.
         * @return bool retorna true si es el dueño y false si no.
         */
        public static function acceso_Pempresa($idEmpresa){
            
            if(isset($_SESSION['id'])){
                echo $_SESSION['id'];
                foreach($_SESSION['empresas'] as $valor)                
                    if($valor['id']==  $idEmpresa)
                        return true;
            }
                
            return false;
        }                
        
        
        
        public static function cerrar_sesion(){
            
            session_destroy();
            header('Location: /natane3/Index/');
        }        
        
        
        public function registrar_usuario(){            
            
            $nombre = $_GET['Rnom'];
            $apellido = $_GET['Rape'];            
            $genero = $_GET['Rgenero'];
            $fecha_nacimiento = $_GET['Rnaci'];
            $correo = $_GET['Rmail'];
            $imagen = "gravatar.jpg";       
            $contraseña = $_GET['Rpass1'];
            $type = 'Usuario';                          
            
            /*Envia los datos al modelo para realizar la consulta*/
            $registrado = $this->modelo->registrar_usuario($nombre,$apellido,$genero,$fecha_nacimiento,$correo,$imagen,$contraseña, $type);
            
            if($registrado)            
                $this->login($correo, $contraseña);
            else 
                echo "<h1>Lo sentimos ocurrio un error intenelo mas tarde</h1>";

            
        }
        
        
        //esta funcion refactoriza la interface de registro de nuevo usuario
        public function mostrar_interface_registro(){
            
             
            $this->vista->refactory_total(); // refactoriza todo el formulario
            
        }

        
        /**
         * Desde esta funcion se inicializan todas la variables
         *de sesion que se necesitan para controlar a la gestion de
         * usuarios
         */                
        public function variables_session($id_usuario){
            
            
            
            $_SESSION['tipo'] = $usuario['tipo'];
            $_SESSION['nick'] = $usuario['nick'];
            
            if($usuario['empresas'])
                $_SESSION['empresas'] = $usuario['empresas'];
                
                $_SESSION['sitios'] = $usuario['sitios'];
            
            
        }



        /**
         * Gestiona el inicio de session del usuario
         * 
         * @param string $user es el email del usuario
         * @param string $pass Contraseña del usuario
         */
        
        public function login($user, $pass){
            
            $usuario = $this->modelo->existe_usuario($user);  //si existe el usuario, retorna en id, sino retorna null
            
            
            
            if($usuario){
                
                if($usuario[0]['password'] == $pass){                   
                                       
                    $_SESSION['id'] = $usuario[0]['idneo4j'];
                    $datosuser = $this->modelo->get_inicio_session($_SESSION['id']);   // trae las demas variables de sesion que necesitamos.                                             
                    $datossitios = $this->modelo->get_sitios($_SESSION['id']); // trae datos de sitios creados por el usuario
                    $datosempresas = $this->modelo->get_empresas($_SESSION['id']); // trae datos de empresas creados por el usuario                                                            
                                        
                    $_SESSION['tipo'] = $datosuser['tipo'];
                    $_SESSION['nick'] = $datosuser['nick'];
                    $_SESSION['img'] = $datosuser['img'];
                    $_SESSION['sitios'] = array();
                    $_SESSION['empresas'] = array();
                    
                    if($datossitios){
                        foreach ($datossitios as $valor)                                   
                            array_push($_SESSION['sitios'], $valor);
                        
                    }
                    if($datosempresas){
                        foreach ($datosempresas as $valor)
                            array_push($_SESSION['empresas'], $valor);                        
                    }
                    
                    
//                    echo $_SESSION['id']."<br>";
//                    echo $_SESSION['tipo']."<br>";
//                    echo $_SESSION['nick']."<br>";
//                    echo $_SESSION['img']."<br>";
//                    print_r($_SESSION['empresas']);
//                    echo "<br>";
//                    print_r($_SESSION['sitios']);
                                                            
                    
                                        
                    header('Location: /natane3/modulos/usuarios/usuario.php?id='.$_SESSION['id']);
                    
                }
            }
        }
    }

?>
