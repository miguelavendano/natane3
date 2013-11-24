<?php 
    require_once 'loginVista.php';    
    require_once 'loginModel.php';
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
     *  En esta sección se realiza validaciones del loguin
     * Verficamos si esta logueado, si el perfil pertenese a la personal logueada
     * y si no esta loqueado restingimos la informaciòn a mostrar por seguiridad de
     * la misma
     */               
        public static function acceso_Pusuario(){
            
            
            
            
        } 
        
        
        public function registrar_usuario(){            
            
            /*Captura los datos pasados por POST*/
            
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
                    $retorno = $this->modelo->get_inicio_session($_SESSION['id']);   // trae las demas variables de sesion que necesitamos.                    
                                        
                    $_SESSION['tipo'] = $retorno['tipo'];
                    $_SESSION['nick'] = $retorno['nick'];
                    $_SESSION['empresas'] = $retorno['empresas'];
                    $_SESSION['sitios'] = $retorno['sitios'];
                    
                    echo $_SESSION['tipo']."<br>";
                    echo $_SESSION['nick']."<br>";
                    echo $_SESSION['empresas']."<br>";
                    echo $_SESSION['sitios']."<br>";
                                        
                    header('Location: /natane3/modulos/usuarios/usuario.php?id='.$_SESSION['id']);
                    
                }
            }
        }
        
        public function main(){            
            

        }
    }

    
    /*Este modulo será utilizado para loguin y
     * para registro de nuevos usuarios.
     * 
     * Inicialmente se valida si es para login o para registrar
     */
    
    

    $opcion = $_GET['enviar'];    

    
    if($opcion == "Registrarme"){    // para registrar
        
        $registrar = new Login();
        //$registrar->mostrar_interface_registro();
        
        $registrar->registrar_usuario();
        

        
    }else{  // para login        
        
        $login = new Login();       

        $login->login($_GET['nickU'], $_GET['claveU']);        
        
    }

?>
