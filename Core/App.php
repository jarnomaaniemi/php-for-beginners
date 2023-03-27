<?php

namespace Core;

/**
 * This class makes container singleton available anyhwere in this application
 * @see https://en.wikipedia.org/wiki/Singleton_pattern
 */
class App
{
    protected static $container;

    /**
     * @param \Core\Container $container
     */
    public static function setContainer($container)
    {
        static::$container = $container;
    }

    /**
     * Get Container
     */
    public static function container()
    {
        return static::$container;
    }

    /**
     * Delegate to Container->bind()
     */
    public static function bind($key, $resolver)
    {
        return static::container()->bind($key, $resolver);
    }

    /**
     * Delegate to Container->resolve()
     */
    public static function resolve($key)
    {
        return static::container()->resolve($key);
    }
}