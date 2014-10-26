<?php 
    require_once 'loginControl.php';    

    //session_start();
    
    /*
     * Este modulo será utilizado para login y
     * para registro de nuevos usuarios.
     * 
     * Inicialmente se valida si es para login o para registrar
     */
       
    $opcion = $_GET['enviar'];    
    
    if($opcion == "Registrarme"){    // para registrar
        
        $registrar = new Login();
        //$registrar->mostrar_interface_registro();
        
        $registrar->registrar_usuario();      
        
    }if($opcion == "Salir"){
        
        session_destroy();
        header('Location: /natane3/Index/');
     
        
    }else{  // para login        
        
        $login = new Login();       
        $login->login($_GET['nickU'], $_GET['claveU']);        
        
    }

?>
