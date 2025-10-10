<?php
require '../helpers.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => 'controllers/home.php',
    '/listings' => 'controllers/listings/index.php',
    '/listings/create' => 'controllers/listings/create.php',
    '404' => 'controllers/error/404.php'
];

//inspectAndDie($uri);

if (key_exists($uri, $routes)) {
    require basePath($routes[$uri]);
} else {
    require basePath($routes['404']);
}
