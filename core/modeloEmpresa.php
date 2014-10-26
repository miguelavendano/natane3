<?php

require_once('coneccion.php');
require_once('Empresa.php');
require_once('Usuario.php');
require_once('Servicio.php');


    use Everyman\Neo4j\Node,
        Everyman\Neo4j\Index,
        Everyman\Neo4j\Query\ResultSet,
        Everyman\Neo4j\Relationship,
        Everyman\Neo4j\Cypher,
        Everyman\Neo4j\Cypher\Query,
        Everyman\Neo4j\Command,
        Everyman\Neo4j\Exception;    


class ModelEmpresa{
    
        public function __construct() {
            
        }
        
        
        /**
         * funcion para crear el nodo tipo Empresa
         * parametros: objeto tipo Empresa
         */	
	public static function crearNodoEmpresa(Empresa $minodo)
	{
            
		if (!$minodo->node) {
            
                    echo "Antes";
                    $minodo->node = new Node(Neo4Play::client());           
                    echo "despues";
                    
		}

                echo "<h3>0</h3>";
		$minodo->node->setProperty('nombre', $minodo->nombre)
				->setProperty('imagen', $minodo->imagen)
				->setProperty('nit', $minodo->nit)
                                ->setProperty('descripcion', $minodo->descripcion)
                                ->setProperty('ciudad', $minodo->ciudad)
                                ->setProperty('telefono', $minodo->telefono)
                                ->setProperty('direccion', $minodo->direccion)
                                ->setProperty('latitud', $minodo->latitud)
                                ->setProperty('longitud', $minodo->longitud)
                                ->setProperty('confianza', $minodo->confianza)                                
                                ->setProperty('correo', $minodo->correo)
                                ->setProperty('sitio_web', $minodo->sitio_web)
                                ->setProperty('facebook', $minodo->facebook)
                                ->setProperty('twitter', $minodo->twitter)
                                ->setProperty('youtube', $minodo->youtube)
                                ->setProperty('contraseña', $minodo->contraseña)
                                ->setProperty('type', $minodo->type)
				->save();       
             
                
                
                echo "<h3>1</h3>";
                      
		$minodo->id = $minodo->node->getId();
                
                echo "<h3>".$minodo->id."</h3>";
            
		$minodoIndex = new Index(Neo4Play::client(), Index::TypeNode,'Empresa');
		$minodoIndex->add($minodo->node, 'nombre', $minodo->nombre);                
	}      

        
	//funcion que edita una propiedad de una empresa y si no existe la crea
	public static function editar_empresa($idnodo, $propiedad, $detalle){
		//Obtengo toda la informacion del nodo
		$editar = Neo4Play::client()->getNode($idnodo);
		//edita la propiedad y si no existe la crea
		$editar->setProperty($propiedad,$detalle)
		    	->save();
	}    

        
        
        public function es_una_empresa($id){
            
            $query = "START n=node(".$id.") RETURN n.type";            
            $queryRes = new Cypher\Query(Neo4Play::client(), $query);      
                    
            if($queryRes){
                $res = $queryRes->getResultSet();                                        
                $tonto= $res[0]->offsetGet('');                
                if($tonto == "Empresa"){                                        
                    return 1;
                }  else {
                    return 0;
                }
                    
            }
                //$experiencia->imagen= "no hay";}            
            
            
        }        
        
        public function get_empresa($queryString){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();
            
            $array = array();
            
            if($result){
            
                foreach($result as $row) {
                    
                    $empresa = new Empresa();
                    $empresa->id = $row['']->getId();
                    $empresa->nombre = $row['']->getProperty('nombre');
                    $empresa->nit = $row['']->getProperty('nit');
                    $empresa->descripcion = $row['']->getProperty('descripcion');
                    $empresa->imagen = $row['']->getProperty('imagen');
                    $empresa->ciudad = $row['']->getProperty('ciudad');
                    $empresa->direccion = $row['']->getProperty('direccion');                    
                    $empresa->telefono = $row['']->getProperty('telefono');
                    $empresa->latitud = $row['']->getProperty('latitud');
                    $empresa->longitud = $row['']->getProperty('longitud');
                    $empresa->confianza = $row['']->getProperty('confianza');
                    $empresa->correo = $row['']->getProperty('correo');
                    $empresa->sitio_web = $row['']->getProperty('sitio_web');                    
                    $empresa->facebook = $row['']->getProperty('facebook');
                    $empresa->twitter = $row['']->getProperty('twitter');
                    $empresa->youtube = $row['']->getProperty('youtube');
                    $empresa->contraseña = $row['']->getProperty('contraseña');
                    $empresa->type = $row['']->getProperty('type');
                    //$empresa->type = $row['']->getProperty('type');                                        
                    array_push($array, $empresa);                    
                }
                return $array;
            }                        
        }                

        
        public function get_contacto($queryString){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);
            
            $result = $query->getResultSet();
            
            $array = array();
            
            if($result){
                
            
                foreach($result as $row) {
                    $empresa = new Empresa();
                    $empresa->id = $row['']->getId();
                    $empresa->nombre = $row['']->getProperty('nombre');
                    $empresa->direccion = $row['']->getProperty('direccion');
                    $empresa->telefono = $row['']->getProperty('telefono');
                    $empresa->direccion = $row['']->getProperty('direccion');
                    $empresa->correo = $row['']->getProperty('correo');
                    $empresa->sitio_web = $row['']->getProperty('sitio_web');                    
                    $empresa->descripcion = $row['']->getProperty('descripcion');  
                    
                    $empresa->confianza = $row['']->getProperty('confianza');
                    
                    $empresa->facebook = $row['']->getProperty('facebook');
                    $empresa->twitter = $row['']->getProperty('twitter');
                    $empresa->youtube = $row['']->getProperty('youtube');  
                    
                    array_push($array, $empresa);

                    
                }
                return $array;
           }
        }        
        
        
        
        public function get_empresa_aleatorio($queryString, $cant){
            
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);
            $result = $query->getResultSet();
            $nodos = array();
            
            foreach ($result as $row){
                
                array_push($nodos, $row['']->getId());                
            }                
            
            $nodale='';
            
            $comparativo = array();
            
            for($i=0; count($comparativo)<$cant; $i++){
                
                $n = rand(0,count($nodos)-1);
                
                if(in_array($n, $comparativo)){
                    
                }else{
                    $nodale.=$nodos[$n];
                    array_push($comparativo, $n);
                    if(count($comparativo)<$cant){
                        $nodale.=",";
                    }                        
                }

            }
            
            
            
            $losconsulta = "START n=node(".$nodale.") RETURN n";
            $consul = new Cypher\Query(Neo4Play::client(), $losconsulta);
            $respuesta = $consul->getResultSet();       
            
            $arsitios = array();
            
            foreach ($respuesta as $row){
                $empresa = new Sitio();
                $empresa->id = $row['']->getId();
                $empresa->nombre = $row['']->getProperty('nombre');
                $empresa->descripcion = $row['']->getProperty('descripcion');
                $empresa->tipo = $row['']->getProperty('tipo');
                $empresa->imagen = $row['']->getProperty('imagen');
                array_push($arsitios, $empresa);
            }
            
            return $arsitios;  

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

        public function get_clientes_aliados($queryString){  
            
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
        
        public function get_servicios($queryString){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();            
            $array = array();
            
            if($result){
                foreach($result as $row) {
                    $servicio = new Servicio();  
                    $servicio->id = $row['']->getId();
                    $servicio->nombre = $row['']->getProperty('nombre');
                    $servicio->descripcion = $row['']->getProperty('descripcion');
                    //$servicio->type = $row['']->getProperty('type');
                    
                    
                    $query="START n=node(".$servicio->id.") MATCH n-[:Img]->i RETURN i.nombre";                     
                    $queryRes = new Cypher\Query(Neo4Play::client(), $query);      
                    $res = $queryRes->getResultSet();
                    
                    if(count($res)){
                        foreach($res as $img) {    
                           $servicio->imagen = $img[''];
                        }
                    }else{
                        $servicio->imagen = "rafting-rio-savegre.jpg";
                    }                    
                    
                    array_push($array, $servicio);
                }
                return $array;
            }           
        }
        
        
        /**
         * Funcion que trae informaion basica sobre las empresas
         * que un usuario ha creado.
         * @param string $id_usuario Es el id noe4j del  usuario a consultar
         * @return array Datos basicos nombre, idemprea... sino posee empresas creadas retorna false.
         */
        public function get_empresa_usuario($id_usuario, $cyper){
            
            $query = new Cypher\Query(Neo4Play::client(), $cyper);
            
            $result = $query->getResultSet();
            
            $array_general = array();
            
            
            if($result){
                
            
                foreach($result as $row) {   
                    
                    $array_empresa = array(
                        'id'=>$row['id'],
                        'nombre'=>$row['nombre'],
                        'imagen'=>$row['imagen']);
                    
                    array_push($array_general, $array_empresa);
                }
                
                return $array_general;
            }else{
                
                return false;
            }                                            
                    
            
        }
        
        public function get_cantidadEmpresasTotal(){
            
            $query = "START n=node(*) where n.type='Empresa' RETURN count(n)";            
            $consulta = new Cypher\Query(Neo4Play::client(), $query);
            $result = $consulta->getResultSet();     
            
            foreach ($result as $row){
                
                $resultado = $row[0];
            }                  
                        
            return $resultado;
        }          
        
}
