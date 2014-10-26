<?php

require_once('core/ConexionMysql.php');


$mysql = new Conexion();

$query ="SELECT * FROM simulacion";

$array = $mysql->get_resultados_query($query); 

print_r($array);

?>
