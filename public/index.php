<?php

// Index page at public folder to prevent access to project root and possible environment variables
// Base path for project root to refer other required files to be required
// funtions.php includes helper functions that are used across the app
// spl_autoload_register to require needed classes (str_replace needed for linux based OS)

const BASE_PATH = __DIR__ . '\\..\\';

require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {
    // $class = str_replace('\\',DIRECTORY_SEPARATOR,$class);
    require base_path("{$class}.php");
});

require base_path('bootstrap.php');

// routes.php uses Router methods to load router $routes with available request paths and their controllers (file paths)
// Request uri and method is read from $_SERVER global variable and feed to route method
// route() requires corresponding controller from loaded $routes

$router = new \Core\Router();
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);