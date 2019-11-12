<?php

use \Slim\Container;

//---------------------------
// CONFIGURACIÓN APP
//---------------------------
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



//---------------------------
// CONTROLLERS
//---------------------------
$container['BasicController'] = function(Container $container){
    return new Src\Controllers\BasicController;
};


$container['UsersController'] = function(Container $container){
    return new Src\Controllers\UsersController;
};
 


//---------------------------
// SERVICES
//---------------------------
$container['UsersService'] = function(Container $container){
    return new \Src\Services\UsersService;
};


//---------------------------
// SEGURIDAD
//---------------------------
$container['CsrfExtension'] = function(Container $container) {
    return new \Src\Infraestructure\Extensions\CsrfExtension($container->get('CSRF'));
};

$container['JWT'] = function (Container $container){
    $jwt = $container->get('settings')['jwt'];
    return new \Src\Utils\JwtManager($jwt['key'], $jwt['iss'], (int)$jwt['expiration']);
};



//---------------------------
// OTROS
//---------------------------
$container['HttpUtils'] = function(Container $container) {
    return new \Src\Utils\HttpUtils;
};

$container['Files'] = function(Container $container) {
    return new \Src\Utils\File;
};


