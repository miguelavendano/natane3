<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/natane3/librerias/neo4jphp.phar');
require_once($_SERVER['DOCUMENT_ROOT'].'/natane3/librerias/Neo4Play.php');

error_reporting(-1);
ini_set('display_errors', 1);

if (!defined('APPLICATION_ENV')) {
	define('APPLICATION_ENV', 'development');
}

$host = 'localhost';
$port = (APPLICATION_ENV == 'development') ? 7474 : 7474;
$transport = new Everyman\Neo4j\Transport($host, $port);
$client = new Everyman\Neo4j\Client($transport);

Neo4Play::setClient($client);

