<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->post('register', 'AuthController::register');


$routes->get('exams/available', 'SubjectController::available');
$routes->get('exams/take/(:num)', 'SubjectController::show/$1');



$routes->group('', ['filter' => 'auth'], function($routes){ //nombre, filtro, callback
    $routes->post('/logout', 'AuthController::logout');
    $routes->get('/tablero', 'HomeController::index');
    // $routes->get('/examenes', 'ExamController::index');
    // $routes->get('/examenes/new', 'ExamController::new'); 
    // $routes->post('/examenes/create', 'ExamController::create'); 
    $routes->get('/perfil', 'ProfileController::index');
    $routes->post('/perfil/change-password', 'ProfileController::changePassword');
    $routes->presenter('usuarios', ['controller' => 'UserController']);
    $routes->presenter('examenes', ['controller' => 'SubjectController']);
    $routes->presenter('preguntas', ['controller' => 'QuestionController']);
    $routes->get('respuestas/show/(:num)', 'ChoiceController::show/$1');
    $routes->post('respuestas/delete/(:num)', 'ChoiceController::delete/$1');
    $routes->post('respuestas/update', 'ChoiceController::update');   
});



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