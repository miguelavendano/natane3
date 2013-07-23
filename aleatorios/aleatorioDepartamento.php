<?php

require_once('coneccion.php');
require_once ('Departamento.php');
require_once ('modeloDepartamento.php');

$municipios=['Acacias'
,'Barranca de Upia'
,'Cabuyaro'
,'Castilla La Nueva'
,'Cubarra'
,'Cumaral'
,'El Calvario'
,'El Castillo'
,'El Dorado'
,'Fuente de Oro'
,'Granada'
,'Guamal'
,'La Macarena'
,'La Uribe'
,'Lejanias'
,'Mapiripán'
,'Mesetas'
,'Puerto Concordia'
,'Puerto Gaitan'
,'Puerto Lleras'
,'Puerto Lopez'
,'Puerto Rico'
,'Restrepo'
,'San Carlos de Guaroa'
,'San Juan de Arama'
,'San Juanito'
,'San Martin'
,'Villavicencio'
,'Vista Hermosa'];

$imagenes=['acacias-meta.jpg'
,'amanecer_llanero.jpg'
,'bailarines-joropo.jpg'
,'cabalgata.jpg'
,'cano-cristales.jpg'
,'coleo.jpg'
,'coleo-casanare.jpg'
,'hotel_llano.jpg'
,'humadea.jpg'
,'joropo.jpg'
,'llanero.jpg'
,'mundial_coleo.jpg'
,'panoramica2.jpg'
,'rafting-rio-savegre.jpg'];

for ($j=0; $j<1; $j++) {
    
    $m=rand(0,28);
    $n=rand(0,13);

    $nom=$municipios[$m];
    echo $nom."<br />";
    $im=$imagenes[$n];
    echo $im."<br />";
    
    $minodo = new Departamento();
    $minodo->nombre = $nom;
    $minodo->imagen = $im;
    $minodo->latitud='4.15';
    $minodo->longitud='-73.64';    
    $minodo->type = 'Departamento';            
    
    ModelDepartamento::crearNodoDepartamento($minodo);
    
}
    
?>

