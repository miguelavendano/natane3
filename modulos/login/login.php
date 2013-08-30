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
            
            
        }
        
        
        //esta funcion refactoriza la interface de registro de nuevo usuario
        public function mostrar_interface_registro(){
            
             
            $this->vista->refactory_total(); // refactoriza todo el formulario
            
        }
        
        public function login($user, $pass){
            
            $id_user = $this->modelo->exite_usuario($user);  //si existe el usuario, retorna en id, sino retorna null
            
            if($id_user){                
                
                //$contra ="";
                $contra = $this->modelo->get_pass($id_user);
                
                echo gettype($contra);
                
                //echo $contra."--".$pass;
                
                if($contra == $pass){
                    
                    $_SESSION['id'] = $id_user;
                    $_SESSION['tipo'] = "usuario";                    
                    header('Location: /natane3/modulos/usuarios/usuario.php?id='.$id_user);
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
    
    

    $opcion = $_GET['opcion'];    

    
    if($opcion == 1){    // para registrar
        
        $registrar = new Login();
        $registrar->mostrar_interface_registro();
        
        
        
        
    }else{  // para login
        
        $login = new Login();       

        $login->login($_GET['usuario'], $_GET['pass']);        
        
    }

?>
