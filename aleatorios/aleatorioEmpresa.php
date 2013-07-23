<?php

require_once('coneccion.php');
require_once 'modeloEmpresa.php';
require_once 'Empresa.php';

$empresas=['Avianca'
,'Federación Nacional de Cafeteros'
,'Manuelita'
,'Incauca'
,'Avidesa Mac Pollo'
,'Grupo Nutresa'
,'Bavaria'
,'Coca-Cola'
,'Alpina'
,'Nestlé de Colombia'
,'Postobón'
,'Colombina'
,'Grupo Quala'
,'Colanta'
,'Unilever Andina'
,'Suramericana'
,'AFP Protección'
,'Seguros Bolívar'
,'Mapfre'
,'Johnson & Johnson'
,'Colgate Palmolive'
,'Procter & Gamble'
,'Sofasa'
,'General Motors - Colmotores'
,'Compañía Colombiana Automotriz'
,'Los Coches la Sabana'
,'Compensar'
,'Cafam'
,'Colsubsidio'
,'Cementos Argos'
,'Cemex Colombia'
,'Arturo Calle'
,'Leonisa'
,'Universidad Nacional de Colombia'
,'Pontificia Universidad Javeriana'
,'Universidad de los Andes'
,'Universidad de Antioquía'
,'Industrias Haceb'
,'Aviatur'
,'Hewlett Packard'
,'Siemens'
,'IBM'
,'Microsoft Colombia'
,'Tecnoquímicas'
,'Pfizer'
,'Roche'
,'Almacenes Éxito'
,'Carrefour'
,'Carulla Vivero'
,'Olímpica'
,'Alkosto'
,'Bancolombia'
,'Helm Bank'
,'Banco de Bogotá'
,'Colpatria'
,'Davivienda'
,'CitiBank'
,'BBVA'
,'Banco de Occidente'
,'Corona'];


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

$imagen=['capachos.jpg'
,'elcielo.jpg'
,'elrancho.png'
,'la80.jpg'
,'lanoche.jpg'
,'mrfrogs.jpg'
,'palosanto.png'
,'paparazzi.jpg'
,'yotoco.png'
,'zona.jpg'];


for ($j=0; $j<19; $j++) {

    $n=rand(0,39);
    $m=rand(0,28);
    $i=rand(0,9);

    $nom=$empresas[$n];   
    echo $nom."<br />";
    $img=$imagen[$i];   
    echo $img."<br />";    
    $desc="En el Grupo Nutresa proporcionamos calidad de vida al consumidor con alternativas de productos que satisfacen sus aspiraciones de nutrición, salud y bienestar e impulsamos estrategias para que se promuevan estilos de vida saludables y alimentación balanceada, así como la toma informada de decisiones.";
    echo $desc."<br />";
    $tel=rand(1,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
    echo $tel."<br />";
    $orig=$municipios[$m];
    echo $orig."<br />";
    $mail=substr($nom,0,4)."_".substr($orig,0,4)."@gmail.com";
    echo $mail."<br />";
    $web=$nom.".co";
    echo $web."<br />";
    $face='http://www.facebook.com/AnDaLaTo';    
    $twit='https://twitter.com/JulianDVarelaP';        
    $you='http://www.youtube.com/user/GisoftCo';
    echo $you."<br />";
    $contra=substr($nom,0,2).substr($orig,0,4);
    echo $contra."<br />";    

    $minodo = new Empresa();
    $minodo->nombre = $nom;
    $minodo->imagen = $img;
    $minodo->nit = '91030105880';    
    $minodo->descripcion = $desc;
    $minodo->ciudad = $orig;
    $minodo->telefono=$tel;
    $minodo->direccion='Calle 41 # 19 A 21 Paraiso';
    $minodo->latitud='4.15';
    $minodo->longitud='-73.64';    
    $minodo->correo = $mail;
    $minodo->sitio_web = $web;    
    $minodo->facebook = $face;
    $minodo->twitter = $twit;
    $minodo->youtube = $you;
    $minodo->contraseña = $contra;
    $minodo->type = 'Empresa';
  
    ModelEmpresa::crearNodoEmpresa($minodo);
    
}
    
?>

