<?php

// Index page at public folder to prevent access to project root and possible environment variables

// Start a session to use and set $_SESSION variables
session_start();

// Base path for project root to refer other required files to be required
const BASE_PATH = __DIR__ . '\\..\\';

// funtions.php includes helper functions that are used across the app
require BASE_PATH . 'Core/functions.php';

// spl_autoload_register to require needed classes (str_replace needed for linux based OS)
spl_autoload_register(function ($class) {
    // $class = str_replace('\\',DIRECTORY_SEPARATOR,$class);
    require base_path("{$class}.php");
});

// Bootstrap to create a serivce container and iniate it to App class (to make services available anywhere in the application)
require base_path('bootstrap.php');

$router = new \Core\Router();

// routes.php uses Router methods to load router with available request paths and their controllers (file paths)
$routes = require base_path('routes.php');

// Request uri and method is read from $_SERVER global variable and feed to route method
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// route() requires corresponding controller from loaded $routes
$router->route($uri, $method);