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
    return new App\Controller\RequestController();
};

// ---------------- SERVICES

/**
 * @param $con \Slim\Container
 * @return \App\Service\RequestService
 */
$container['RequestService'] = function ($con) {
    $service = new \App\Service\RequestService();
    return $service;
};

// ---------------- DB
/**
 * @param $con \Slim\Container
 * @return \Illuminate\Database\Capsule\Manager as Database
 */
$container['db'] = function ($con) {
    $database = new Illuminate\Database\Capsule\Manager();
    $database->addConnection([
        'driver'    => 'mysql',
        'database'  => 'Skeleton',
        'username'  => 'skeleton_user',
        'password'  => 'skeleton_pass',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci'
    ]);
    $database->setAsGlobal();
    $database->bootEloquent();

    return $database;
};