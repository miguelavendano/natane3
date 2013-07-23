<?php

require_once('coneccion.php');
require_once('Empresa.php');


use Everyman\Neo4j\Node,
    Everyman\Neo4j\Index;

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
			$minodo->node = new Node(Neo4Play::client());
		}

		$minodo->node->setProperty('nombre', $minodo->nombre)
				->setProperty('imagen', $minodo->imagen)
				->setProperty('nit', $minodo->nit)
                                ->setProperty('descripcion', $minodo->descripcion)
                                ->setProperty('ciudad', $minodo->ciudad)
                                ->setProperty('telefono', $minodo->telefono)
                                ->setProperty('direccion', $minodo->direccion)
                                ->setProperty('latitud', $minodo->latitud)
                                ->setProperty('longitud', $minodo->longitud)
                                ->setProperty('correo', $minodo->correo)
                                ->setProperty('sitio_web', $minodo->sitio_web)
                                ->setProperty('facebook', $minodo->facebook)
                                ->setProperty('twitter', $minodo->twitter)
                                ->setProperty('youtube', $minodo->youtube)
                                ->setProperty('contraseña', $minodo->contraseña)
                                ->setProperty('type', $minodo->type)
				->save();        
                      
		$minodo->id = $minodo->node->getId();
                echo $minodo->id;
		$minodoIndex = new Index(Neo4Play::client(), Index::TypeNode,'Empresa');
		$minodoIndex->add($minodo->node, 'nombre', $minodo->nombre);
	}      
        
        
}
