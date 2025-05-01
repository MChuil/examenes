<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->post('/login', 'AuthController::login');
$routes->post('register', 'AuthController::register');





$routes->group('', ['filter' => 'auth'], function($routes){ //nombre, filtro, callback
    $routes->post('/logout', 'AuthController::logout');
    $routes->get('/tablero', 'HomeController::index');
    
    $routes->group('alumno', function($routes){
        $routes->get('examenes', 'SubjectController::available');
        $routes->get('examen/(:num)', 'SubjectController::resolver/$1');

        $routes->post('examen/guardar/(:num)', 'SubjectController::guardarRespuestas/$1');

        $routes->get('historial', 'SubjectController::historial');
        $routes->get('historial/(:num)', 'SubjectController::verResultados/$1');


    });
    
    // $routes->get('/examenes', 'ExamController::index');
    // $routes->get('/examenes/new', 'ExamController::new'); 
    // $routes->post('/examenes/create', 'ExamController::create'); 
    $routes->get('/perfil', 'ProfileController::index');
    $routes->post('/perfil/change-password', 'ProfileController::changePassword');
    

    // Se protege la ruta para administradores
    $routes->group('', ['filter'=> 'admin'], function($routes){
        $routes->presenter('usuarios', ['controller' => 'UserController']);
        $routes->presenter('examenes', ['controller' => 'SubjectController']);
        $routes->presenter('preguntas', ['controller' => 'QuestionController']);
        $routes->get('respuestas/show/(:num)', 'ChoiceController::show/$1');
        $routes->post('respuestas/delete/(:num)', 'ChoiceController::delete/$1');
        $routes->post('respuestas/update', 'ChoiceController::update');   
    });


    // Ruta especial para admnistradores, aqui le aplicas el filtro de Admin
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