<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('register', 'Auth::register');
$routes->post('register/process', 'Auth::processRegister');
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true); // atau false kalau kamu mau full manual
$routes->get('/users/list', 'Users::list');
$routes->get('/users/create', 'Users::createForm');
$routes->post('/users/create', 'Users::create');
$routes->get('/users/edit/(:num)', 'Users::editForm/$1');
$routes->post('/users/update/(:num)', 'Users::update/$1');
