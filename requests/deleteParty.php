<?php
session_start();
$json = json_decode(file_get_contents('php://input'), true);
require ($_SERVER['DOCUMENT_ROOT'] ."/includes/classloader.php");

(new EnvReader($_SERVER['DOCUMENT_ROOT'] . '/.env'))->load();

$source = $_SERVER['DOCUMENT_ROOT'];
$dir = $source . '/elements/';
require($dir . "elementfunctions.php");

$database = new Dbconfig(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASSWORD"), getenv("DB_NAME"));
$db = $database->getConnection();
$sqlQuery = new Sql($db);
$databases;


$deletePartyRow = $sqlQuery->deletePartyRow($json['postID']);
return json_encode($json['postID']);

?>