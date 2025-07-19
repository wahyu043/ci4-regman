<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('register', 'Auth::register');
$routes->post('register/process', 'Auth::processRegister');
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true); // atau false kalau kamu mau full manual
$routes->get('users', 'Auth::listUsers');


// $routes->get('/', 'Home::index');
// $routes->match(['get', 'post'], 'register', 'Auth::register');
// $routes->match(['get', 'post'], 'tesdebug', 'Auth::tesDebug');
