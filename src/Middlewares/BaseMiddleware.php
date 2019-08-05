<?php namespace Src\Middlewares;


abstract class BaseMiddleware
{
    protected $container;
    public function __construct($container)
    {
        $this->container = $container;
    }
}