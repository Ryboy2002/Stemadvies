<?php
session_start();
$_SESSION["id"] = 3;


require (__DIR__ ."/includes/classloader.php");

(new EnvReader(__DIR__ . '/.env'))->load();

$source = $_SERVER['DOCUMENT_ROOT'];
$dir = $source . '/elements/';
require($dir . "elementfunctions.php");

$database = new Dbconfig(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASSWORD"), getenv("DB_NAME"));
$db = $database->getConnection();
$sqlQuery = new Sql($db);
$databases;

$dir = __DIR__;


$request = $_SERVER['REQUEST_URI'];
$url = parse_url($request);

$urlpaths = explode("/", $url["path"]);
switch($urlpaths[1]) {
case '/':
case '':
case 'index':
    case 'welkom':
require __DIR__ . '/webpage/login.php';
break;
case 'admin':
require __DIR__ . '/webpage/admin.php';
break;
case 'login':
require __DIR__ . '/webpage/login.php';
break;
case 'search':
require __DIR__ . '/webpage/search.php';
break;
case 'register':
require __DIR__ . '/webpage/register.php';
break;
case 'test':
require __DIR__ . '/webpage/create_profile.php';
break;
default:
require __DIR__ . '/webpage/404.php';
header("HTTP/1.1 404 Not Found");
break;
}
?>