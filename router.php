<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

function abort($code = 404) {
    http_response_code($code);
    require "views/{$code}.php";
    die();
}

function routeToController($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        abort();
    }
}

$routes = require 'routes.php';

routeToController($uri, $routes);