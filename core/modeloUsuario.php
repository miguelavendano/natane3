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
                //echo $minodo->id;
		$minodoIndex = new Index(Neo4Play::client(), Index::TypeNode,'Usuario');
		$minodoIndex->add($minodo->node, 'nombre', $minodo->nombre);
                
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
                    
                    
                    array_push($array, $usuario);
                    
//                                $usuario->nick = $row['']->getProperty('nombre');
//				$usuario->nick = $row['']->getProperty('apellido');
//				$usuario->nick = $row['']->getProperty('imagen');
//				$usuario->nick = $row['']->getProperty('nick');
//                                $usuario->nick = $row['']->getProperty('genero');    
//                                $usuario->nick = $row['']->getProperty('fecha_nacimiento');
//                                $usuario->nick = $row['']->getProperty('ciudad_origen');
//                                $usuario->nick = $row['']->getProperty('lugar_recidencia');
//                                $usuario->nick = $row['']->getProperty('correo');
//                                $usuario->nick = $row['']->getProperty('sitio_web');
//                                $usuario->nick = $row['']->getProperty('facebook');
//                                $usuario->nick = $row['']->getProperty('twitter');
//                                $usuario->nick = $row['']->getProperty('youtube');
//                                $usuario->nick = $row['']->getProperty('contraseña');
//                                $usuario->nick = $row['']->getProperty('type');                    
                    
                    
                    
                    
                    
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
                    $usuario->nick = $row['']->getProperty('nick');
                    $usuario->imagen = $row['']->getProperty('imagen');
                    array_push($array, $usuario);
                    
                    
                }
                return $array;
            }

        }        
        
        
}
