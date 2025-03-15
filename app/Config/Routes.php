<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->post('/login', 'AuthController::login');

$routes->get('/tablero', 'HomeController::index');

// $routes->get('/examenes', 'ExamController::index');

// $routes->get('/examenes/new', 'ExamController::new'); 

// $routes->post('/examenes/create', 'ExamController::create'); 


$routes->get('/perfil', 'ProfileController::index');

$routes->post('/perfil/change-password', 'ProfileController::changePassword');

$routes->presenter('usuarios', ['controller' => 'UserController']);
$routes->presenter('examenes', ['controller' => 'SubjectController']);
$routes->presenter('preguntas', ['controller' => 'QuestionController']);


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