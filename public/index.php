<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';
require '../helpers.php';

use Framework\Router;

/* autoload manual comentado por que o projeto foi posteriormente configurado com composer para usar um autoloader já predefinido com composer install.
spl_autoload_register(function ($class) {
    $path = basePath('Framework/' . $class . '.php');
    if (file_exists($path)) require $path;
});
*/

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$router = new Router();
require basePath('routes.php');
$router->route($uri);
