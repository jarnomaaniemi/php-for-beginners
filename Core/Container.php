<?php

namespace Core;

/**
 * Simplified service container.
 * A container is a class or a data structure whose instances are collections of other objects.
 * @see https://en.wikipedia.org/wiki/Container_(abstract_data_type)
 */
class Container
{
    protected $bindings = [];

    /**
     * Add to container
     * @param string $key Identifier
     * @param function $resolver e.g. builder funtion to create Database object
     */
    public function bind($key, $resolver)
    {
        $this->bindings[$key] = $resolver;
    }

    /**
     * @param string $key Identifier to call a resolver from the container
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
