<?php
session_start();
require_once('../../core/coneccion.php');
require_once('../../core/modeloSitio.php');
require_once('../../core/modeloExperiencia.php');
require_once('../../core/modeloImagen.php');
require_once('../../core/modeloRelaciones.php');

    //obtiene la cadena a consultar
    $texto = '(?i).*'.$_GET['term'].'.*'; // se agrega *  para que realice la busqueda con elementeos que empiezen por el texto enviado

    /*BUSCA LOS SITIOS*/            
    $query = "START n=node(*) WHERE n.type = 'Sitio' AND n.nombre =~ '".$texto."' RETURN Id(n) as id, n.nombre as nombre";

    $modelsitios = new ModelSitios();            
    $resultado_sitios = $modelsitios->get_sitio_exp($query);
    //$resultado_sitios = $modelsitios->get_nombre_sitios($query);
    
    echo json_encode($resultado_sitios);    
    
    //return json_encode($resultado_sitios);    
            
?>
