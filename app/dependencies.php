<?php

/**
 * Service factory for the ORM
 * @param $container \Slim\Container
 * @return \Illuminate\Database\Capsule\Manager as Database
 */
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

/**
 * @param $container \Slim\Container
 * @return \Slim\Views\Twig
 */
$container['view'] = function ($container) {
    $paths = [
        'public/views',
        // 'public/views/login'
    ];
    $view = new \Slim\Views\Twig($paths, [
        // 'cache' => 'src/cache'
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment( new \Slim\Http\Environment( $_SERVER ) );
    $view->addExtension( new \Slim\Views\TwigExtension($router, $uri) );

    return $view;
};


// ---------------------------
// CONTROLLERS
// ---------------------------

/**
 * @param $container \Slim\Container
 * @return \App\Controller\RequestController
 */
$container['RequestController'] = function($container){
    return new App\Controller\RequestController($container);
};

/**
 * @param $container \Slim\Container
 * @return \App\Controller\UsersController
 */
$container['UsersController'] = function($container){
    return new App\Controller\UsersController($container);
};

// ---------------------------
// SERVICES
// ---------------------------
$container['UsersService'] = function($container){
    return new \App\Services\UsersService($container);
};

// ---------------------------
// OTHERS
// ---------------------------

$container['csrf'] = function($container) {
    return new \Slim\Csrf\Guard;
};

$container['Logger'] = function($container) {
    return new \App\Classes\FlatLogger();
};

$container['HttpUtils'] = function($container) {
    return new \App\Classes\HttpUtils();
};