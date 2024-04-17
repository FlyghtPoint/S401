<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Max-Age: 3600");
http_response_code(200);

require_once __DIR__.'/../app/bootstrap.php';
require __DIR__.'/../app/Router.php';
$routes = require __DIR__.'/../app/config/routes.php';

$router = new Router();

$method = $_SERVER['REQUEST_METHOD'];
$url = $_SERVER['REQUEST_URI'];

foreach ($routes as $route) {
    $router->addRoute($route['method'], $route['path'], [$route['controller'], $route['action']]);
}

$router->dispatch($method, $url);
?>