<?php

require_once('coneccion.php');
require_once('modeloImagen.php');
require_once('Imagen.php');

$imagen=['acacias-meta.jpg'
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
,'rafting-rio-savegre.jpg'
,'mandragora.jpg'
,'c1.jpg'
,'c2.jpg'
,'c3.jpg'
,'c4.jpg'
,'c5.jpg'
,'c6.jpg'
,'c7.jpg'
,'c8.jpg'
,'c9.jpg'
,'c10.jpg'
,'c11.jpg'
,'c12.jpg'
,'c13.jpg'
,'c14.jpg'
,'c15.jpg'];

$descibe=[
'foto bonita'
,'fue divertido'
,'que chimba'
,'he tenido mejores'
,'me diverti restos'
,'la locura'
,'lo mejor que he visto'
,'se gozo :D'
,'aguanta regresar :)'
,'la pasamos del putas 3:)'
,'es bellos... recomendado'
,'se los recomiendo a todos... (Y)'
,'Feliz... :D'
,'no tengo palabras para describirlo'
,'pudo estar mejor'
,'esperaba mas'
,'que desecpcion :/'
,'muy mal planeado'
,'muy comico lo que nos paso alli'
,'jajaja... muy bueno'
,'mas bello para donde'
,'esto fue lo peor'
,'no falta el sapo'
,'que viva la rumba'
,'te estraño mucho'
,'a dormir se dijo'];

for ($j=0; $j<50; $j++) {
    
    $n=rand(0,25);
    $d=rand(0,25);

    $nom=$imagen[$n];   
    echo $nom."<br />";
    $desc=$descibe[$d];
    echo $desc."<br />";
    $comen=$descibe[$n];
    echo $comen."<br />";
    
    $minodo = new Imagen();
    $minodo->nombre = $nom;
    $minodo->descripcion = $desc;
    $minodo->comentario1 = $comen;    
    $minodo->type = 'Imagen';  
    
    ModelImagen::crearNodoImagen($minodo);
    
}
    
?>

