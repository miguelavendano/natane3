<?php
    require_once ('../core/modeloSitio.php');
    require_once ('../core/modeloPublicacion.php');
    require_once ('../core/modeloUsuario.php');
    require_once ('../core/modeloNodos.php');
    require_once ('../core/modeloEmpresa.php');

    class ModelSimulacion{       
        
        
        public $modelsitios;
        public $modelempresas;
        public $modelusuarios;
        public $modelnodos;
        
        public function __construct() {
        
            $this->modelsitios = new ModelSitios();
            $this->modelempresas= new ModelEmpresa();
            $this->modelusuarios = new ModelUsuarios();
            $this->modelnodos = new ModelNodos();
        
        }
        
        
        public function get_sitios(){   
            
            $query = "START n=node(*) WHERE n.type='Sitio' RETURN n;";            
            $resultado = $this->modelsitios->get_sitio_aleatorio($query, 3);

            return $resultado;
            
        }                

        public function get_empresas(){   
            
            $query = "START n=node(*) WHERE n.type='Empresa' RETURN n;";            
            $resultado = $this->modelempresas->get_empresa_aleatorio($query, 3);

            return $resultado;
            
        }                        
        
        public function get_usuarios(){   
                        
            $query = "START n=node(*) WHERE n.type='Usuario' RETURN n";            
            $resultado = $this->modelusuarios->get_usuarios_aleatorios($query,3);
        
            return $resultado;            
        }        
        
        public function get_cantidadNodos($opcion){
            
            $resultado="";
            switch ($opcion){
                case 1: // Total de nodos                        
                    $resultado = $this->modelnodos->get_cantidadNodosTotal();
//                    echo '<script>alert("si hay opcion".$resultado);</script>';
                
                    return $resultado;                                            
                    
                case 2: // Total de usuarios
                    $resultado = $this->modelusuarios->get_cantidadUsuarioaTotal();
//                    echo '<script>alert("si hay opcion".$resultado);</script>';
                
                    return $resultado;                                                                
                    
                case 3: // Total de sitios
                    
                    $resultado = $this->modelsitios->get_cantidadSitiosTotal();
//                    echo '<script>alert("si hay opcion".$resultado);</script>';
                
                    return $resultado;                                                                                   
                    
                case 4: // Total de empresas
                    
                    $resultado = $this->modelempresas->get_cantidadEmpresasTotal();
//                    echo '<script>alert("si hay opcion".$resultado);</script>';
                
                    return $resultado;                       
                    
                default:
                    
                    
                    break;
                    
                
            }

        }
        
    }   
?>