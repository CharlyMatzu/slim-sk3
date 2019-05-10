<?php namespace App\Controller;

use Illuminate\Database\Query\Builder;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

abstract class BaseController{

    private $view;
    private $logger;
    protected $table;

    /**
     * BaseController constructor.
     * @param Twig $view
     * @param LoggerInterface $logger
     * @param Builder $table
     */
    public function __construct(Twig $view = null,  LoggerInterface $logger = null, Builder $table = null)
    {
        $this->view = $view;
        $this->logger = $logger;
        $this->table = $table;
    }
}