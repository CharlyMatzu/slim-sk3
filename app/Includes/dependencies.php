<?php
/**
 * Created by PhpStorm.
 * User: Carlos R. Zuñiga
 * Date: 20/08/2018
 * Time: 04:01 PM
 */


/**
 * @param $con \Slim\Container
 * @return \App\Controller\RequestController
 */
$container['RequestController'] = function($con){
    return new App\Controller\RequestController();
};

/**
 * @param $con \Slim\Container
 */
$container['DB'] = function ($con) {
    //$myService = new MyService();
    //return $myService;
};


// Register Twig View helper

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
//        'cache' => 'src/cache'
    ]);

    // Instantiate and add Slim specific extension
    $router = $con->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment( new \Slim\Http\Environment( $_SERVER ) );
    $view->addExtension( new \Slim\Views\TwigExtension($router, $uri) );

    return $view;
};
