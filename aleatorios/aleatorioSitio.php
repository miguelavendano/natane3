<?php
require_once('coneccion.php');
require_once('modeloSitio.php');
require_once('Sitio.php');

$sitios=['Parque de los Fundadores'
,'Parque Sikuani'
,'Parque de la Vida'
,'Parque Infantil'
,'Plazoleta de los Libertadores '
,'Parque del Hacha'
,'Plazoleta los Centauros'
,'Parque de los Estudiantes'
,'Parque de Banderas'
,'Instituto Roberto Franco '
,'Biblioteca Pública Municipal Germán Arciniegas'
,'Glorieta de la Grama'
,'Monumento al Folclor Llanero'
,'Monumento a las Arpas'
,'Monumento A Cristo Rey'
,'Monumento al Coleo'
,'Casa de la cultura'
,'Catedral de Nuestra Señora del Carmen'
,'Bioparque los Ocarros'
,'Parapente'
,'Caminata a Cristo Rey.'
,'Caminata ecológica'
,'Puentismo'
,'Rafting'
,'Parque Las Malocas'
,'Jardín botánico'];

$descibe=[
'En este espacio se podrá recrear dando una caminata por un sitio de casi 6 hectáreas con zonas verdes, juegos infantiles, una fuente iluminada y un lago artificial. Lo puede visitar en la intersección de la ruta que va a Acacias y cruza con la ruta a Puerto López.'
,'En este sitio recreativo disfrutará de canchas de tenis, basketball, piscinas con toboganes, juegos mecánicos y cafeterías.'
,'Se ubica en el extremo de la avenida circunvalar y aquí usted y su familia encontrarán piscinas, restaurante y campos deportivos para niños y adultos.'
,'Visite el parque alrededor del cual se fundo la ciudad, en las casa circundantes aun se mantiene la arquitectura típica de esta época.'
,'Donde usted observará los bustos del General Francisco de Paula Santander, y el libertador Simón Bolívar, está ubicada en el Parque Principal de Villavicencio, a su alrededor están el edificio de la gobernación y la catedral.'
,'En este parque encontrará la escultura de un hacha en honor a los colonos de la región, su nombre real es Parque José Eustasio Rivera.'
,'La Plazoleta cuenta con una escultura que hace honor al Centauro Llanero, a su alrededor se pueden encontrar tabernas donde se puede ver la cultura llanera.'
,'Aquí se puede ver el monumento “Espíritu y Sangre” del maestro Álvaro Vásquez, es un sitio muy frecuentado por estudiantes.'
,'Ubicado en el barrio San Fernando, frente al Palacio de Justicia y al Coliseo Álvaro Mesa Amaya, allí podrá conocer el busto del prócer de la ciudad Antonio Villavicencio, en festividades se izan banderas de los departamentos del país.'
,'En esta estación de Biología Tropical, usted puede ver un Jardín de tortugas, micro-hábitat adecuado para mantener las especies de tortugas. Además, este es un centro de conservación del caimán negro del Orinoco.'
,'Se inauguró en octubre de 1997. Es un importante sitio de información, un gran complejo cultural proyectado para fomentar el desarrollo de la ciencia, el arte y la cultura.'
,'Ubicada en la antigua vía a Bogotá, aquí podrá conocer una hermosa fuente de agua iluminada haciendo alusión a caño cristales.'
,'Ubicado en el cruce de la Avenida da Llano y la Avenida Catama, tiene un monumento en representación de las raíces llaneras.'
,'Este es un hermoso monumento ubicado en la glorieta de la vía al aeropuerto Vanguardia, por la vía al municipio de Restrepo. Consta de tres gigantescas estructuras metálicas, de las cuales caen chorros de agua de colores, aludiendo cuerdas del arpa. '
,'Aquí aparte de tener una vista panorámica de Villavicencio y el llano, también puede ver el monumento en honor a cristo rey, obra inaugurada en 1954.'
,'Ubicado en la Avenida del Llano, justo donde comienza la vía nueva hacia el municipio de Restrepo, es el homenaje al coleo, esta es una importante es cultura que no puede dejar de visitar.'
,'Aquí se presentan las diferentes muestras culturales de la ciudad, cuenta con una biblioteca y cuenta con el cine club Villavicencio, donde se proyectan películas de gran calidad cultural. Se ubica dos cuadras arribe del parque principal.'
,'Ofició la primera misa el 2 de febrero de 1894, aunque había sido destruida en el incendio de 1890, en su interior se presenta un estilo gótico.'
,'Aquí puede observar aproximadamente 1200 animales de 193 especies, en un entorno muy similar al natural, en el cual se mezclan con la fauna y la flora de esta región, el parque cuenta también con un amplio serpentario y un mariposario. Esta ubicado a tres kilómetros de Villavicencio por la vía que conduce al municipio de Restrepo.'
,'Para los amantes de volar, realice vuelos desde el mirador de Buenavista en la vereda Somalia, por la antigua vía Bogota. '
,'Ruta caminera la escalinata esta ruta se toma por un callejón e la carrera 42, se toman las escalinatas bordeando el Caño Parrado y se toman las 22º escalinatas hasta la vía del cerro de Cristo Rey. Todo el camino se puede apreciar un hermoso paisaje y desde la cima se vera la inmensidad del llano.'
,'Ruta el carmen, por la vía de Villacentro a la urbanización Balcones de Toledo, se sigue por el sendero a la escuela de la vereda El Carmen y siguiendo hacia la vereda La Samaria hasta descender por Buenavista en la antigua vía a Bogota.'
,'Bocatoma de puente abadía es el sitio ideal para practicar ciclo montañismo y puentismo aparte de rapel desde el borde de un puente colgante a 80 metros de altura. Allí se lega por la antigua vía al municipio de Restrepo por la vía de Bavaria a las veredas La Argentina y Santa Maria baja.'
,'Vereda Puente Abadía es el sitio para realizar rafting, rapel y puentismo, por la entrada de Bavaria en la antigua vía al municipio de Restrepo. '
,'En este parque conocerá la vida del llanero por medio de una visita guiada por sitios como las caballerizas los corrales y la casa del hato santa helena que es una representación de una casa típica del llano. Aquí se presentan faenas de llano. Además, durante su visita al Parque usted conocerá la comida típica del llano y realizar una cabalgata por el hato.'
,'Para ver las especies de flora y fauna de la Orinoquia vaya al jardín botánico que se ubica en el barrio Mesetas, aquí disfrutara de un buen clima haciendo una caminata por un bosque en el cual podrá ver distintos animales como ardillas y diferentes tipos de aves'];

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


$categorias=['Bar','Discoteca','Restaurante','Parque','Cultural','Deporte'];


for ($j=0; $j<20; $j++) {

    $n=rand(0,25);
    $t=rand(0,5);
    $m=rand(0,28);
    $i=rand(0,29);
    
    $nom=$sitios[$n];   
    echo $nom."<br />";    
    $desc=$descibe[$n];
    echo $desc."<br />";
    $img=$imagen[$i];   
    echo $img."<br />";     
    $tip=$categorias[$t];
    echo $tip."<br />";
    $tel=rand(1,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
    echo $tel."<br />";
    $orig=$municipios[$m];
    echo $orig."<br />";
    $mail=substr($nom,0,4)."_".substr($orig,0,4)."@gmail.com";
    echo $mail."<br />";
    $web=$nom.".co";
    echo $web."<br />";
    $face='http://facebook.com/Liis.R.Jmz';    
    $twit='https://twitter.com/andreita371';      
    $you='http://www.youtube.com/user/GisoftCo';
    echo $you."<br />";
    $contra=substr($nom,0,3).substr($orig,0,3);
    echo $contra."<br />";    

    $minodo = new Sitio();
    $minodo->nombre = $nom;
    $minodo->imagen = $img;
    $minodo->tipo_sitio = $tip;    
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
    $minodo->type = 'Sitio';
      
    echo "busca 0";
    $sitio = new ModelSitios();
    
    echo "busca 1";
    $sitio->crearNodoSitio($minodo);
    
}
    
?>

