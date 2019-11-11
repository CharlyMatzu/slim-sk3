<?php

use Carbon\Carbon;
use Slim\Container;

$container['View'] = function (Container $container) {
    // información proveniente de settings.php
    $settings = $container->get('settings')['view'];

    $view = new \Slim\Views\Twig($settings['template_path'], [
        'cache' => $settings['cache']
    ]);

    $router = $container->get('router');

    $uri = isset($settings['base_path'])
        ? $settings['base_path']
        : \Slim\Http\Uri::createFromEnvironment( new \Slim\Http\Environment( $_SERVER ) );

    $view->addExtension( new \Slim\Views\TwigExtension($router, $uri) );

    return $view;
};


$container['DB'] = function (Container $container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};


$container['Logger'] = function (Container $container) {
    $settings = $container->get('settings')['logger'];

    $now = Carbon::now()->format('Y-m-d');
    $logPath = $settings['path'] . '/' . $now . '.log';

    $logger = new \Monolog\Logger($settings['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($logPath, $settings['level']));
    return $logger;
};
