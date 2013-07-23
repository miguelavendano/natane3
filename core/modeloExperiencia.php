<?php

require_once('coneccion.php');
require_once('Experiencia.php');


use Everyman\Neo4j\Node,
    Everyman\Neo4j\Index;

class ModelExperiencia{
    
        public function __construct() {
            
        }
        
        
        /**
         * funcion para crear el nodo tipo Experiencia
         * parametros: objeto tipo Experiencia
         */	
	public static function crearNodoExperiencia(Experiencia $minodo)
	{
		if (!$minodo->node) {
			$minodo->node = new Node(Neo4Play::client());
		}

		$minodo->node->setProperty('nombre', $minodo->nombre)
				->setProperty('descripcion', $minodo->descripcion)
                                ->setProperty('type', $minodo->type)
				->save();

		$minodo->id = $minodo->node->getId();
                //echo $minodo->id;
		$minodoIndex = new Index(Neo4Play::client(), Index::TypeNode,'Experiencia');
		$minodoIndex->add($minodo->node, 'nombre', $minodo->nombre);
                                
	}      
        
        
}
