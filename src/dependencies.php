<?php

/**
 * @param $container \Slim\Container
 * @return \Illuminate\Database\Capsule\Manager
 */
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

/**
 * Twig render
 * @param $container \Slim\Container
 * @return \Slim\Views\Twig
 */
$container['view'] = function ($container) {
    $paths = $container['settings']['render']['paths'];
    $view = new \Slim\Views\Twig($paths, [
        // $container['settings']['render']['cache']
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment( new \Slim\Http\Environment( $_SERVER ) );
    $view->addExtension( new \Slim\Views\TwigExtension($router, $uri) );

    return $view;
};


// monolog
// $container['logger'] = function ($c) {
//     $settings = $c->get('settings')['logger'];
//     $logger = new \Monolog\Logger($settings['name']);
//     $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
//     $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
//     return $logger;
// };


// ---------------------------
// CONTROLLERS
// ---------------------------

/**
 * @param $container \Slim\Container
 * @return \Src\Controllers\RequestController
 */
$container['RequestController'] = function($container){
    return new Src\Controllers\RequestController($container);
};

/**
 * @param $container \Slim\Container
 * @return \Src\Controllers\UsersController
 */
$container['UsersController'] = function($container){
    return new Src\Controllers\UsersController($container);
};

// ---------------------------
// SERVICES
// ---------------------------
$container['UsersService'] = function($container){
    return new \Src\Services\UsersService($container);
};

// ---------------------------
// OTHERS
// ---------------------------

$container['csrf'] = function($container) {
    return new \Slim\Csrf\Guard;
};

$container['Logger'] = function($container) {
    return new \Src\Classes\FlatLogger();
};

$container['HttpUtils'] = function($container) {
    return new \Src\Classes\HttpUtils();
};

$container['Files'] = function($container) {
    return new \Src\Classes\Files();
};