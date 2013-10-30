<?php 
    require_once 'loginVista.php';    
    require_once 'loginModel.php';
    require_once '../../core/Validar.php';


    class Login{

        public $vista;
        public $modelo;        
        
        
        public function __construct() {            
            $this->vista = new LoginVista();
            $this->modelo = new LoginModel();
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
        
        public function login($user, $pass){
            
            $usuario = $this->modelo->existe_usuario($user);  //si existe el usuario, retorna en id, sino retorna null
            
            if($usuario){
                if($usuario[0]['password'] == $pass){
                    
                    $_SESSION['id'] = $usuario[0]['idneo4j'];
                    //$_SESSION['tipo'] = "usuario";   hay que verificar el login de los diferentes tipos de usuarios que existen
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
