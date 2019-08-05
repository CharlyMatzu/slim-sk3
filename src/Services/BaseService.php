<?php namespace Src\Services;


abstract class BaseService
{
    protected $container;
    public function __construct($container)
    {
        $this->container = $container;
    }
}