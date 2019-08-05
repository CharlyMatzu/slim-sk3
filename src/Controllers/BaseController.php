<?php namespace Src\Controllers;

use Illuminate\Database\Query\Builder;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

abstract class BaseController{

    protected $container;
    public function __construct($container)
    {
        $this->container = $container;
    }
}