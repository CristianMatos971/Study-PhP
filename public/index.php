<?php
require '../helpers.php';
require basePath('router.php');
require basePath('Database.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router = new Router();
require basePath('routes.php');
$router->route($uri, $method);
