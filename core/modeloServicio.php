<?php

require_once('coneccion.php');
require_once('Servicio.php');


use Everyman\Neo4j\Node,
    Everyman\Neo4j\Index;

class ModelServicio{
    
        public function __construct() {
            
        }
        
        /**
         * funcion para crear el nodo tipo Servicio
         * parametros: objeto tipo Servicio
         */	
	public static function crearNodoServicio(Servicio $minodo)
	{
		if (!$minodo->node) {
			$minodo->node = new Node(Neo4Play::client());
		}

		$minodo->node->setProperty('nombre', $minodo->nombre)                        
				->setProperty('descripcion', $minodo->descripcion)
                                ->setProperty('type', $minodo->type)
				->save();

		$minodo->id = $minodo->node->getId();                
		$minodoIndex = new Index(Neo4Play::client(), Index::TypeNode,'Servicio');
		$minodoIndex->add($minodo->node, 'nombre', $minodo->nombre);
                
	}      
        
        
}
