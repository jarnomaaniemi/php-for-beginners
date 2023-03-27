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
 * Create user variable into $_SESSION 
 * @param array $user User information e.g. id, email.
 */
function login($user)
{
    $_SESSION['user'] = [
        'id' => $user['id'],
        'email' => $user['email']
    ];

    session_regenerate_id(true);
}

/**
 * Empty $_SESSION, destroy session data and browser cookie
 */
function logout()
{
    $_SESSION = [];
    session_destroy();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}
