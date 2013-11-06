<?php

require_once('coneccion.php');
require_once('Usuario.php');


use Everyman\Neo4j\Node,
    Everyman\Neo4j\Index,
    Everyman\Neo4j\Query\ResultSet,
    Everyman\Neo4j\Relationship,
    Everyman\Neo4j\Cypher,
    Everyman\Neo4j\Cypher\Query,
    Everyman\Neo4j\Command;

class ModelUsuarios{
    
        public function __construct() {
            
        }        
        
        /**
         * funcion para crear el nodo tipo Usuario
         * parametros: objeto tipo Usuarios
         */	
	public static function crearNodoUsuario(Usuario $minodo)
	{
		if (!$minodo->node) {
			$minodo->node = new Node(Neo4Play::client());
		}

		$minodo->node->setProperty('nombre', $minodo->nombre)
				->setProperty('apellido', $minodo->apellido)
				->setProperty('imagen', $minodo->imagen)
				->setProperty('nick', $minodo->nick)
                                ->setProperty('genero',$minodo->genero)    
                                ->setProperty('fecha_nacimiento', $minodo->fecha_nacimiento)
                                ->setProperty('ciudad_origen', $minodo->ciudad_origen)
                                ->setProperty('lugar_recidencia', $minodo->lugar_recidencia)
                                ->setProperty('correo', $minodo->correo)
                                ->setProperty('sitio_web', $minodo->sitio_web)
                                ->setProperty('facebook', $minodo->facebook)
                                ->setProperty('twitter', $minodo->twitter)
                                ->setProperty('youtube', $minodo->youtube)
                                ->setProperty('contraseña', $minodo->contraseña)
                                ->setProperty('type', $minodo->type)
				->save();

		$minodo->id = $minodo->node->getId();
                
		$minodoIndex = new Index(Neo4Play::client(), Index::TypeNode,'Usuario');
		$minodoIndex->add($minodo->node, 'nombre', $minodo->nombre);
                
	}      
        
        
	//funcion que edita una propiedad de un usuario y si no existe la crea
	public static function editar_usuario($idnodo, $propiedad, $detalle){
		//Obtengo toda la informacion del nodo
		$editar = Neo4Play::client()->getNode($idnodo);
		//edita la propiedad y si no existe la crea
		$editar->setProperty($propiedad,$detalle)
		    	->save();
	}            
        
        
        public function get_id($valor, $opcion){
            
            
            switch ($opcion){
                
                case "correo":
                    
                    $queryString = "start n=node(*) where n.type='Usuario' and n.correo='".$valor."' return id(n) as id;";                    
                    
                    $query = new Cypher\Query(Neo4Play::client(), $queryString);            
                    $result = $query->getResultSet();   
                    
                    if(count($result)>0){
                        $id_user = $result[0]['id'];                        
                        
                        return $id_user;                                                
                        
                    }else{
                        
                        return 0;
                    }
                    

                      

                    
            }           
            
        }
        
        
        
        /**
         * Retonar un valor boleano true si este usuario ha creado alguna 
         * empresa y false de lo contrario
         * 
         * @return bool true si ha creado empresas false sino.
         * 
         */
        public function get_empresas_creadas($id_user){
            
            $queryString = "START n=node(".$id_user.") MATCH n-[:Crea]->e RETURN count(e) as Nempresas;";
            $query = new Cypher\Query(Neo4Play::client(), $queryString);
            $result = $query->getResultSet();
            return $result[0]['Nempresas'];
            
        }
        
        /**
         * Retonar un valor boleano true si este usuario ha publicado algun
         * sitio y false de lo contrario.
         * 
         * @return bool true si ha creado empresas false sino.
         * 
         */        
        public function get_sitios_publicados($id_user){

            $queryString = "START n=node(".$id_user.") MATCH n-[:Publica]->s RETURN count(s) as Nsitios;";
            $query = new Cypher\Query(Neo4Play::client(), $queryString);
            $result = $query->getResultSet();
            return $result[0]['Nsitios'];            
            
        }
        

        /**
         * Retorna el nick del usuario pasado por parametro.
         * 
         * @return string el nick del usuario.
         */
        public function get_nick($id_user){
            
            $queryString = "start n=node(".$id_user.") return n.nick as nick";
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();              
            
            return $result[0]['nick'];
            
        }
        

        /**
         * Retorna el tipo del usuario pasado por parametro.
         * 
         * @return string el tipo del usuario.
         */
        public function get_tipo($id_user){
            
            $queryString = "start n=node(".$id_user.") return n.type as tipo";
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();              
            
            return $result[0]['tipo'];
            
        }        
        
        
        
        
        public function get_pass($id_user){
            
            $queryString = "start n=node(".$id_user.") return n";
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();              
            
            return $result[0]['']->getProperty('contraseña');
            
            
        }
        
        
                    
        public function get_usuario($queryString){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();
            
            $array = array();
            
            if($result){
                
            
                foreach($result as $row) {
                    $usuario = new Usuario();
                    $usuario->id = $row['']->getId();
                    
                    $usuario->nick = $row['']->getProperty('nick');
                    $usuario->imagen = $row['']->getProperty('imagen');
                    $usuario->genero = $row['']->getProperty('genero');    
                    $usuario->fecha_nacimiento = $row['']->getProperty('fecha_nacimiento');
                    $usuario->lugar_recidencia = $row['']->getProperty('lugar_recidencia');
                    $usuario->correo = $row['']->getProperty('correo');
                    $usuario->sitio_web = $row['']->getProperty('sitio_web');                    
                                        
                    
                        $usuario->nombre = $row['']->getProperty('nombre');
                        $usuario->apellido = $row['']->getProperty('apellido');
                        //$usuario->imagen = $row['']->getProperty('imagen');
                        //$usuario->nick = $row['']->getProperty('nick');
                        //$usuario->genero = $row['']->getProperty('genero');    
                        //$usuario->fecha_nacimiento = $row['']->getProperty('fecha_nacimiento');
                        $usuario->ciudad_origen = $row['']->getProperty('ciudad_origen');
                        //$usuario->lugar_recidencia = $row['']->getProperty('lugar_recidencia');
                        //$usuario->correo = $row['']->getProperty('correo');
                        //$usuario->sitio_web = $row['']->getProperty('sitio_web');
                        $usuario->facebook = $row['']->getProperty('facebook');
                        $usuario->twitter = $row['']->getProperty('twitter');
                        $usuario->youtube = $row['']->getProperty('youtube');
                        $usuario->contraseña = $row['']->getProperty('contraseña');
                        //$usuario->type = $row['']->getProperty('type');                    
                    
                    array_push($array, $usuario);
                    
                }
                return $array;
            }            
            
        }
        
        
        public function get_amigos($queryString){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);
            $result = $query->getResultSet();
            
            $array = array();
            
            if($result){
            
                foreach($result as $row) {
                    
                    $usuario = new Usuario();  
                    $usuario->id = $row['']->getId();
                    $usuario->type = $row['']->getProperty('type');
                    $usuario->nick = $row['']->getProperty('nick');
                    $usuario->nombre = $row['']->getProperty('nombre');
                    $usuario->imagen = $row['']->getProperty('imagen');
                    array_push($array, $usuario);
                    
                }
                return $array;
            }
        }        
                
        public function get_visitantes($queryString){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();
            
            $array = array();
            
            if($result){
                
            
                foreach($result as $row) {
                    $usuario = new Usuario();
                    $usuario->id = $row['']->getId();
                    $usuario->nick = $row['']->getProperty('nick');
                    $usuario->imagen = $row['']->getProperty('imagen');
                    array_push($array, $usuario);
                    
                    
                }
                return $array;
            }
        }
        
        public function get_desean($queryString){
            
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();
            
            $array = array();
            
            if($result){               
            
                foreach($result as $row) {
                    $usuario = new Usuario();
                    $usuario->id = $row['']->getId();
                    $usuario->nick = $row['']->getProperty('nick');
                    $usuario->imagen = $row['']->getProperty('imagen');
                    array_push($array, $usuario);
                                        
                }
                return $array;
            }

        }      
        
        
        /**
         * La idea de esta funcion es que ejecute consultas que tengan que 
         * ver con usuarios.
         * @return array con los datos que se necesitan para inicializar variable se session
         */
        
        public function get_datos_session($query, $id_usuario) {
                        
            //echo $this->get_empresas_creadas($id_usuario);                      
            
            $query = new Cypher\Query(Neo4Play::client(), $query);            
            $result = $query->getResultSet();                        
            
            //echo $result[0]['tipoUser'];

            $user = array(
                "tipo"=>$result[0]['tipoUser'],
                "nick"=>$result[0]['nick'],
                "empresas"=>$this->get_empresas_creadas($id_usuario),
                "sitios"=>$this->get_sitios_publicados($id_usuario)
            );
            
            return $user;

        }
            
        
        
        
}
