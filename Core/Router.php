<?php

namespace Core;

/**
 * Simple router
 */
class Router
{
    protected $routes = [];

    protected function add($method, $uri, $controller)
    {
        // Possibility to use php function compact('method', 'uri', 'controller')
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function get($uri, $controller)
    {
        $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        $this->add('PUT', $uri, $controller);
    }

    /**
     * Find a match from loaded routes and require corresponding controller (file)
     */
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                require base_path($route['controller']);
            }
        }

        $this->abort();
    }

    /**
     * Failed request with http status code
     */
    protected function abort($code = 404) {
        http_response_code($code);
        require base_path("views/{$code}.php");
        die();
    }
}