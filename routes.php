<?php

$router->get('/', 'HomeController@index');
$router->get('/listings', 'ListingsController@index');
$router->get('/listings/create', 'ListingsController@create');
$router->get('/listings/edit/{id}', 'ListingsController@edit');
$router->get('/listings/{id}', 'ListingsController@show');

$router->put('/listings/{id}', 'ListingsController@update');
$router->post('/listings/create', 'ListingsController@store');
$router->delete('listings/{id}', 'ListingsController@destroy');

$router->get('/auth/register', 'UserController@create');
$router->get('/auth/login', 'UserController@login');

$router->post('/auth/register', 'UserController@store');
$router->post('/auth/logout', 'UserController@logout');
$router->post('/auth/login', 'UserController@authenticate');

/* 
$router->get('/', 'controllers/home.php');
$router->get('/listings', 'controllers/listings/index.php');
$router->get('/listings/create', 'controllers/listings/create.php');
$router->get('/listing', 'controllers/listings/show.php');
 */
