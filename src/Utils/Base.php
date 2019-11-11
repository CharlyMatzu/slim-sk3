<?php namespace Src\Utils;

use Psr\Container\ContainerInterface;

abstract class Base
{
    protected $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}