<?php

// Public pages
$router->get('/',          'HomeController@index');
$router->get('/about',     'HomeController@about');
$router->get('/services',  'HomeController@services');
$router->get('/contact',   'HomeController@contact');

// Auth
$router->get('/login',            'AuthController@showLogin');
$router->post('/login',           'AuthController@login');
$router->get('/register/agent',   'AuthController@showRegisterAgent');
$router->post('/register/agent',  'AuthController@registerAgent');
$router->get('/register/buyer',   'AuthController@showRegisterBuyer');
$router->post('/register/buyer',  'AuthController@registerBuyer');
$router->get('/logout',           'AuthController@logout');

// Agent - protected (Auth::requireAgent() called in PropertyController constructor)
$router->get('/agent/dashboard',              'PropertyController@dashboard');
$router->get('/agent/properties',             'PropertyController@index');
$router->get('/agent/properties/create',      'PropertyController@create');
$router->post('/agent/properties',            'PropertyController@store');
$router->get('/agent/properties/single',      'PropertyController@single');
$router->post('/agent/properties/delete',     'PropertyController@delete');
$router->post('/agent/properties/update',     'PropertyController@update');

// Edit route - must come after /create to avoid conflict
$router->get('/agent/properties/edit',        'PropertyController@edit');

// Images
$router->post('/agent/images/add',    'ImageController@add');
$router->post('/agent/images/update', 'ImageController@update');
$router->post('/agent/images/delete', 'ImageController@delete');

// AJAX
$router->post('/ajax/lgas', 'AjaxController@getLGAs');
