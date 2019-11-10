<?php

use Slim\Http\Request;
use Slim\Http\Response;

// --------- CORS

$app->add(function (Request $req, Response $res, Callable $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});


// --------- CUSTOM

$container['RequestMiddleware'] = function($container){
    return new Src\Middleware\RequestMiddleware;
};
