<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default setting
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('register');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// Auth routes
$routes->get('register', 'Auth::register');
$routes->post('register/process', 'Auth::processRegister');
$routes->get('logout', 'Auth::logout');



// Users CRUD
$routes->get('users/list', 'Users::list');
$routes->get('users/create', 'Users::createForm');
$routes->post('users/create', 'Users::create');
$routes->get('users/edit/(:num)', 'Users::editForm/$1');
$routes->post('users/update/(:num)', 'Users::update/$1');
$routes->get('users/delete/(:num)', 'Users::delete/$1');
