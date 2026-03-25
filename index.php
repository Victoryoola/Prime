<?php

session_start();

// Config (defines APPROOT, URLROOT, DB constants)
require_once 'app/config/config.php';

// Core
require_once 'app/models/Database.php';
require_once 'app/models/UserModel.php';
require_once 'app/models/PropertyModel.php';
require_once 'app/models/LocationModel.php';
require_once 'app/helper/Auth.php';
require_once 'app/Router.php';
require_once 'app/controllers/Controller.php';

// Controllers
require_once 'app/controllers/HomeController.php';
require_once 'app/controllers/AuthController.php';
require_once 'app/controllers/PropertyController.php';
require_once 'app/controllers/ImageController.php';
require_once 'app/controllers/AjaxController.php';

// Parse URI
$basePath = '/Estate';
$uri      = $_SERVER['REQUEST_URI'];
$path     = strtok(substr($uri, strlen($basePath)) ?: '/', '?') ?: '/';
$method   = $_SERVER['REQUEST_METHOD'];

// Dispatch
$router = new Router();
require_once 'app/routes/web.php';
$router->dispatch($method, $path);
