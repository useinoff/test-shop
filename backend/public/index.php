<?php
require "../bootstrap.php";
use Src\Controller\ProductController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

if (! in_array($uri[1], ['product', 'random'])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$param = $uri[2] ?? null;

$requestMethod = $_SERVER["REQUEST_METHOD"];

$controller = new ProductController($dbConnection, $requestMethod, $param, $uri[1]);
$controller->processRequest();