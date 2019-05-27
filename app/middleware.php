<?php

use Slim\Http\Request;
use Slim\Http\Response;


$container['RequestMiddleware'] = function($container){
    return new App\Middlewares\RequestMiddleware($container);
};

$app->add(new \App\Middlewares\CorsMiddleware($container));
//$container['CorsMiddleware'] = function ($container){
//    return new \App\middleware\CorsMiddleware($container);
//};
