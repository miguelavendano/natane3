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
                    $usuario->ciudad_origen = $row['']->getProperty('ciudad_origen');
                    $usuario->facebook = $row['']->getProperty('facebook');
                    $usuario->twitter = $row['']->getProperty('twitter');
                    $usuario->youtube = $row['']->getProperty('youtube');
                    $usuario->contraseña = $row['']->getProperty('contraseña');
                    $usuario->type = $row['']->getProperty('type');                    
                    
                    array_push($array, $usuario);
                    
                }
                return $array;
            }            
            
        }
        

        public function aletorio($cant){                       
            
            $vector = array();            
                                
            while (count($vector)<$cant){
                
                $n = rand( 0 ,$cant);
                                              
                if(in_array($n, $vector)){
                                        
                }else{
                    array_push($vector, $n); 
                  
                }   
            }           
            
            return $vector;
        } 
        
        public function get_usuarios_aleatorios($queryString,$cant){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $result = $query->getResultSet();
            
            $idnodos = array();            
            
            foreach ($result as $row){
            
                array_push($idnodos, $row['']->getId());                
            }                
            
            $nodale='';
            
            $comparativo = array();

            for($i=0; count($comparativo)<$cant; $i++){
                
                $n = rand(0,count($idnodos)-1);
                
                if(in_array($n, $comparativo)){
                    
                }else{
                    $nodale.=$idnodos[$n];
                    array_push($comparativo, $n);
                    if(count($comparativo)<$cant){
                        $nodale.=",";
                    }                        
                }
            }

            
            $losconsulta = "START n=node(".$nodale.") RETURN n";
            $consul = new Cypher\Query(Neo4Play::client(), $losconsulta);
            $respuesta = $consul->getResultSet();       
            
            $array = array();            
            
            if($result){
                foreach($respuesta as $row) {
                    $usuario = new Usuario();
                    $usuario->id = $row['']->getId();                    
                    $usuario->nick = $row['']->getProperty('nick');
                    $usuario->imagen = $row['']->getProperty('imagen');
                    $usuario->nombre = $row['']->getProperty('nombre');
                    $usuario->apellido = $row['']->getProperty('apellido');                    
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

        /*
        public function get_AmigosDeAmigos($queryString){

            $query = new Cypher\Query(Neo4Play::client(), $queryString);            
            $amigos = $query->getResultSet();                                              
            $lis_amigos = array();

            foreach($amigos as $ami) {                 
                
                $query = "start n=node(".$ami['']->getId().") match n<-[:Amigo]->a return a";
                $queryRes = new Cypher\Query(Neo4Play::client(), $query);                          
                $usuario = $queryRes->getResultSet();                    
                
                    $id_amigo = $ami['']->getId();
                    $imagen_amigo = $ami['']->getProperty('imagen');                    
                    $type_a = "";
                    
                    if($ami['']->getProperty('type') == "Empresa"){ //valida si es una empresa o un usuario el dueño de esta imagen
                        $nick_usuario=$usuario[0]['']->getProperty('nombre');                
                        $type_a="Empresa";
                    }else{
                        $nick_amigo = $ami['']->getProperty('nick');
                        $nombre_amigo = $ami['']->getProperty('nombre')." ".$ami['']->getProperty('apellido');
                        $type_a="Usuario";
                    }
                    
                    $id_usuario=$usuario[0]['']->getId();
                    $img_usuario=$usuario[0]['']->getProperty('imagen'); 
                    $type_u = "";
                    
                    if($usuario[0]['']->getProperty('type') == "Empresa"){ //valida si es una empresa o un usuario el dueño de esta imagen
                        $nick_usuario=$usuario[0]['']->getProperty('nombre');                
                        $type_u="Empresa";
                    }else{
                        $nick_usuario=$usuario[0]['']->getProperty('nick');  
                        $nombre_usuario=$usuario[0]['']->getProperty('nombre')." ".$usuario[0]['']->getProperty('apellido');  
                        $type_u="Usuario";
                    }
                    
                    $retorno = array(
                        'type_usuario'=>$type_u,
                        'id_usuario'=>$id_usuario,
                        'img_usuario'=>$img_usuario,
                        'nick_usuario'=>$nick_usuario,
                        'nombre_usuario'=>$nombre_usuario,
                        'type_amigo'=>$type_a,
                        'id_amigo'=>$id_amigo,
                        'img_amigo'=>$imagen_amigo,
                        'nick_amigo'=>$nick_amigo,
                        'nombre_amigos'=>$nombre_amigo                       
                        );

                    array_push($lis_amigos, $retorno);                                                                    
            }
            
            return $lis_amigos;
        }
        */
            
        public function get_AmigosDeAmigos($queryString){
            
            $query = new Cypher\Query(Neo4Play::client(), $queryString);
            $result = $query->getResultSet();
            $array = array();
           
            if($result){
            
//                $ids_amigos = array();
//                $pos_repetidos = array();
//                
//                foreach($result as $row) {                    
//                    array_push($ids_amigos, $row['']->getId());
//                }                            
//                
//                sort($ids_amigos);      //ordena los ids de los amigos
//                
////                foreach ($ids_amigos as $clave => $valor) {
////                    echo "ids_amigos[" . $clave . "] = " . $valor . "\n";
////                }                
//
//                //busca la posicion de los ids repetidos
//                for($i=1;count($ids_amigos)-1>$i;$i++){
//                    if($ids_amigos[$i]==$ids_amigos[$i-1]){
//                        array_push($pos_repetidos, $i);
//                    }                    
//                }
//                
////                foreach ($pos_repetidos as $clave => $valor) {
////                    echo "pos_repetidos[" . $clave . "] = " . $valor . "\n";
////                }                
//                    
//                //elimina los elementos repetidos de la lista
//                for($i=0;count($pos_repetidos)>$i;$i++){
//                    unset($ids_amigos[$pos_repetidos[$i]]);                    
//                }
//                
////                foreach ($ids_amigos as $clave => $valor) {
////                    echo "ids_amigos[" . $clave . "] = " . $valor . "\n";
////                }                     
              
                
                foreach($result as $row) {
                                                                
                            $usuario = new Usuario();  
                            $usuario->id = $row['']->getId();
                            $usuario->type = $row['']->getProperty('type');
                            $usuario->nick = $row['']->getProperty('nick');
                            $usuario->nombre = $row['']->getProperty('nombre');
                            $usuario->apellido = $row['']->getProperty('apellido');
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
                "img"=>$result[0]['img'],
                "empresas"=>$this->get_empresas_creadas($id_usuario),
                "sitios"=>$this->get_sitios_publicados($id_usuario)
            );
            
            return $user;

        }
            
        
        
}