<?php

require_once('coneccion.php');
require_once('Administrador.php');
require_once('Usuario.php');

use Everyman\Neo4j\Node,
    Everyman\Neo4j\Index,
    Everyman\Neo4j\Query\ResultSet,
    Everyman\Neo4j\Relationship,
    Everyman\Neo4j\Cypher,
    Everyman\Neo4j\Cypher\Query,
    Everyman\Neo4j\Command;


class ModelAdministrador{
    
        public function __construct() {
            
        }        
        
        /**
         * funcion para crear el nodo tipo Administrador
         * @param objeto $minodo Objeto de tipo Administrador
         */        
	public static function crearNodoAdministrador(Administrador $minodo){
		if (!$minodo->node) {
			$minodo->node = new Node(Neo4Play::client());
		}

		$minodo->node->setProperty('nombre', $minodo->nombre)
				->setProperty('apellido', $minodo->apellido)
				->setProperty('imagen', $minodo->imagen)
                                //->setProperty('genero',$minodo->genero)    
                                //->setProperty('fecha_nacimiento', $minodo->fecha_nacimiento)
                                ->setProperty('correo', $minodo->correo)
                                ->setProperty('password', $minodo->password)
                                ->setProperty('type', $minodo->type)
				->save();

		$minodo->id = $minodo->node->getId();
                
		$minodoIndex = new Index(Neo4Play::client(), Index::TypeNode,'Administrador');
		$minodoIndex->add($minodo->node, 'nombre', $minodo->nombre);
                
	}      
        
        
        /**
         * Funcion que edita una propiedad de un administrador y si no existe la crea
         * 
         * @param integer $idnodo ID del nodo administrador a editar
         * @param string $propiedad Propiedad del nodo administrador a editar
         * @param string $detalle Detalle a ingresar en la propiedad
         */
	public static function editar_usuario($idnodo, $propiedad, $detalle){
		//Obtengo toda la informacion del nodo
		$editar = Neo4Play::client()->getNode($idnodo);
		//edita la propiedad y si no existe la crea
		$editar->setProperty($propiedad,$detalle)
		    	->save();
	}            
               
        
        /**
         * Retorna el nombre y apellido del administrador pasado por parametro.
         * @param integer $id_user ID de administrador a consultar
         * @return string $administrador Nombre completo del administrador.
         */
        public static function get_nombre_admin($id_user){
            
            $queryString = "start n=node(".$id_user.") return n.nombre, n.apellido";
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();              
            
            return $result[0]['nombre']." ".$result[0]['apellido'];
            
        }
        
        /**
         * Retorna la clave del administrador pasado por parametro.
         * @param integer $id_user ID de administrador a consultar
         * @return string $password Clave de acceso del administrador.
         */        
        public static function get_pass($id_user){
            
            $queryString = "start n=node(".$id_user.") return n";
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();              
            
            return $result[0]['']->getProperty('password');
            
        }

        
        /**
         * Retorna toda la informacion del nodo del administrador.
         * @param string $queryString Consulta que trae el ID del administrador a consultar
         * @return array $array Array con los datos del nodo del administrador.
         */                                   
        public static function get_administrador($queryString){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();
            
            $array = array();
            
            if($result){
                
                foreach($result as $row) {
                    $usuario = new Usuario();
                    $usuario->id = $row['']->getId();                    
                    $usuario->nombre = $row['']->getProperty('nombre');
                    $usuario->apellido = $row['']->getProperty('apellido');                    
                    $usuario->imagen = $row['']->getProperty('imagen');                    
                    //$usuario->genero = $row['']->getProperty('genero');    
                    //$usuario->fecha_nacimiento = $row['']->getProperty('fecha_nacimiento');
                    $usuario->correo = $row['']->getProperty('correo');
                    $usuario->password = $row['']->getProperty('password');
                    $usuario->type = $row['']->getProperty('type');                    
                    
                    array_push($array, $usuario);
                }
                return $array;
            }                        
        }
                  
        
        /**
         * Funcion que obtiene las usuarios con mas seguidores o los que han compartido mas experiencias
         * @param string $queryString cadena de texto que contiene los ID de los nodos Usuario
         * @param string $filtro cadena de texto que especifica si se busca los usuarios que mas seguidores tienen
         * o los que han compartido mas experiencias
         */
        public static function get_usuariosVistaAdmin($queryString, $filtro){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();            
            $array = array();
            $populares = array();
            
            if($result){
                foreach($result as $row) {

                    $query="START n=node(".$row['']->getId().") ".$filtro;
                    $queryRes = new Cypher\Query(Neo4Play::client(), $query);      
                    $res = $queryRes->getResultSet();
                    
                    $populares[$row['']->getId()] = $res[0]->offsetGet('');
                }
                
                arsort($populares);
                //print_r($populares);
                $cont=0;
                
                foreach($populares as $key=>$value){                    
                    
                    foreach($result as $row) {
                        
                        if($row['']->getId() == $key AND $cont<9){
                            
                            $usuario = new Usuario();
                            $usuario->id = $row['']->getId();                    
                            $usuario->nick = $row['']->getProperty('nick');
                            $usuario->imagen = $row['']->getProperty('imagen');
                            $usuario->nombre = $row['']->getProperty('nombre');
                            $usuario->apellido = $row['']->getProperty('apellido');                    
                            array_push($array, $usuario);
                            $cont++;
                        }
                    }
                }
                
                return $array;
            }           
        }
               

        /**
         * Esta funcion consulta la cantidad de nodos de un mismo tipo
         * @param string $tipoNodo Cadena de texto que especifica el tipo de nodo a buscar
         * @return integer $total Retorna la cantidad de usuarios registrados
         */        
        public static function get_totalNodos($tipoNodo) {
            
            $queryString = "START n=node(*) WHERE n.type='".$tipoNodo."' RETURN count(n) as total";
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();              
            
            return $result[0]['total'];
        }               
        
        /**
         * Esta funcion consulta la cantidad de relaciones existentes segun el tipo enviado por parametro
         * @param string $tipoRelacion Tipo de relacion sobre la cual se ejecuta la consulta
         * @return integer $total Retorna la cantidad de relaciones existentes
         */        
        public static function get_totalRelaciones($tipoRelacion) {
            
            $queryString = "START n=node(*) MATCH n-[:".$tipoRelacion."]->i RETURN count(n) as total";
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();              
            
            return $result[0]['total'];
        }     
        
        
        /**
         * La idea de esta funcion es que ejecute consultas que tengan que 
         * ver con usuarios.
         * @return array con los datos que se necesitan para inicializar variable se session
         */
        
//        public function get_datos_session($query, $id_usuario) {
//                        
//            //echo $this->get_empresas_creadas($id_usuario);                      
//            
//            $query = new Cypher\Query(Neo4Play::client(), $query);            
//            $result = $query->getResultSet();                        
//            
//            //echo $result[0]['tipoUser'];
//
//            $user = array(
//                "tipo"=>$result[0]['tipoUser'],
//                "nick"=>$result[0]['nick'],
//                "img"=>$result[0]['img'],
//                "empresas"=>$this->get_empresas_creadas($id_usuario),
//                "sitios"=>$this->get_sitios_publicados($id_usuario)
//            );
//            
//            return $user;
//
//        }
            
        
        
}