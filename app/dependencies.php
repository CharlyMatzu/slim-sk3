<?php

// ---------------- RENDER

/**
 * @param $con \Slim\Container
 * @return \Slim\Views\Twig
 */
$container['view'] = function ($con) {
    $paths = [
        'public/views',
        // 'public/views/login'
    ];
    $view = new \Slim\Views\Twig($paths, [
        // 'cache' => 'src/cache'
    ]);

    // Instantiate and add Slim specific extension
    $router = $con->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment( new \Slim\Http\Environment( $_SERVER ) );
    $view->addExtension( new \Slim\Views\TwigExtension($router, $uri) );

    return $view;
};


// ---------------- CONTROLLERS

/**
 * @param $con \Slim\Container
 * @return \App\Controller\RequestController
 */
$container['RequestController'] = function($con){
    $view   = $con->get('view');
    return new App\Controller\RequestController($view);
};

/**
 * @param $con \Slim\Container
 * @return \App\Controller\UsersController
 */
$container['UsersController'] = function($con){
    $logger = $con->get('logger');
    $table  = $con->get('skeleton')->table('');
    return new App\Controller\UsersController($logger, $table);
};


/**
 * Service factory for the ORM
 * @param $con \Slim\Container
 * @return \Illuminate\Database\Capsule\Manager as Database
 */
$container['db'] = function ($con) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($con['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};