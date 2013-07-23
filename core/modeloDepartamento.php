<?php

require_once('coneccion.php');
require_once('Departamento.php');


use Everyman\Neo4j\Node,
    Everyman\Neo4j\Index;

class ModelDepartamento{
    
        public function __construct() {
            
        }
        
        
        /**
         * funcion para crear el nodo tipo Departamento
         * parametros: objeto tipo Departamento
         */	
	public static function crearNodoDepartamento(Departamento $minodo)
	{
		if (!$minodo->node) {
			$minodo->node = new Node(Neo4Play::client());
		}

		$minodo->node->setProperty('nombre', $minodo->nombre)
				->setProperty('imagen', $minodo->imagen)
				->setProperty('latitud', $minodo->latitud)
                                ->setProperty('longitud', $minodo->longitud)
                                ->setProperty('type', $minodo->type)
				->save();

		$minodo->id = $minodo->node->getId();
                echo $minodo->id;
		$minodoIndex = new Index(Neo4Play::client(), Index::TypeNode,'Departamento');
		$minodoIndex->add($minodo->node, 'nombre', $minodo->nombre);
                
	}      
        
        
}
