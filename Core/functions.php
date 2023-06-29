<?php

use Core\Response;

/**
 * Die and dump variable
 */
function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';

    die();
}

/**
 * Check if REQUEST_URI same as given URI
 */
function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

/**
 * Failed request. Http response code and error view.
 */
function abort($code = 404)
{
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

/**
 * Authorize current user
 */
function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}

/**
 * Project-root/$path
 */
function base_path($path)
{
    return BASE_PATH . $path;
}

/**
 * Load a view with given attributes (data)
 */
function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('views/' . $path);
}

/**
 * Set header location and exit script
 * @param string $path
 */
function redirect($path) {
    header("location: {$path}");
    exit();
}