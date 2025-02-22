<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');

$routes->get('/examenes', 'ExamController::index');

$routes->get('/examenes/new', 'ExamController::new'); 

$routes->post('/examenes/create', 'ExamController::create'); 


$routes->get('/perfil', 'ProfileController::index');

$routes->presenter('usuarios', ['controller' => 'UserController']);


// $routes->get('/saludo/(:alpha)', 'Home::welcome/$1');

// $routes->get('/productos', 'ProductController::index');
// $routes->get('/productos/(:num)', 'ProductController::show/$1');

/**
 * (:num) numeros
 * (:any) cualquier cosa
 * (:alpha) solo letras
 * (:alphanum) letras y numeros
 * (:segment) cualquier cosa excepto /
 */