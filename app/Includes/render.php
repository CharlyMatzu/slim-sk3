<?php
// Register Twig View helper

$container['view'] = function ($c) {
    $paths = [
        'public/views/dashboard',
        'public/views/login'
    ];
    $view = new \Slim\Views\Twig($paths, [
//        'cache' => 'src/cache'
    ]);

    // Instantiate and add Slim specific extension
    $router = $c->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment( new \Slim\Http\Environment( $_SERVER ) );
    $view->addExtension( new \Slim\Views\TwigExtension($router, $uri) );

    return $view;
};