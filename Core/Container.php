<?php

namespace Core;

class Container
{
    protected $bindings = [];

    /**
     * Add to container bindings
     */
    public function bind($key, $function)
    {
        $this->bindings[$key] = $function;
    }

    /**
     * "Take out" of container to use it
     */
    public function resolve($key)
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new \Exception("No matching binding found for {$key}");
        }

        $resolver = $this->bindings[$key];

        return call_user_func($resolver);
    }
}
