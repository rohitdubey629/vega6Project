<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'home::index');
$routes->get('/home', 'home::index');
$routes->get('/login', 'home::login');


$routes->get('/fPassword', 'home::fPassword');
$routes->post('/user_regis', 'home::user_regis');
// $routes->get('/dashboard/(:any)', 'home::dashboard/$1');

$routes->get('/dashboard', 'home::dashboard');
$routes->post('/checkLogin', 'home::checkLogin');
$routes->get('/logout', 'home::logout');
$routes->post('/changePassword', 'home::changePassword');

$routes->get('/userprofile', 'home::userprofile');
$routes->post('/editUser', 'home::editUser');
$routes->post('/userUpdate', 'home::userUpdate');

$routes->get('/search', 'home::search');
