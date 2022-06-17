<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

error_reporting(E_ALL);
ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

$router->setNamespace('Controllers');

// login
$router->post('/login', 'UserController@login');
$router->post('/bedrijf/login', 'BedrijfController@login');

// users
$router->post('/users/create', 'UserController@createUser');
$router->put('/users/(\d+)/update', 'UserController@updateUser');
$router->get('/users', 'UserController@getAllUsers');                       // admin
$router->get('/users/(\d+)', 'UserController@getOneById');
$router->delete('/users/(\d+)', 'UserController@deleteUser');               // user of admin
$router->get('/users/current', 'UserController@getCurrentUser');

// companys
$router->post('/bedrijven/create', 'BedrijfController@createCompany');
$router->put('/bedrijven/(\d+)/update', 'BedrijfController@updateCompany'); // bedrijf
$router->get('/bedrijven', 'BedrijfController@getAllCompanys');
$router->get('/bedrijven/(\d+)', 'BedrijfController@getOneById');
$router->delete('/bedrijven/(\d+)', 'BedrijfController@deleteCompany');     //admin
$router->get('/bedrijven/current', 'BedrijfController@getCurrentCompany');

// recenties
$router->post('/recenties/create', 'RecentieController@createOne');
$router->get('/recenties', 'RecentieController@getAll');
$router->get('/recenties/(\d+)', 'RecentieController@getOneById');
$router->post('/recenties/(\d+)', 'RecentieController@react');              //bedrijf
$router->delete('/recenties/(\d+)', 'RecentieController@deleteOne');        //admin

// Run it!
$router->run();