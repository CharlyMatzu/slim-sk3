<?php

use Slim\Container;
use Slim\Csrf\Guard;
use Slim\Http\Request;
use Slim\Http\Response;



//--------------------------------
// Security
//--------------------------------

// --------- CORS (global)

$app->add(function (Request $req, Response $res, Callable $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

// --------- CSRF Protection Middleware
$container['CSRF'] = function(Container $container){
    $guard = new Slim\Csrf\Guard();
    $guard->setPersistentTokenMode(true);

    // Por defecto se retorna el estatus 400 con un mensaje por defecto, para personalizar
    // se utiliza el método siguiente:
    $guard->setFailureCallable(function (Request $request, Response $response, $next) {
        return $response->write('Not Passed CSRF check.');

        // En caso de fallar la validación se puede enviar el atributo 'csrf_status' en el request
        // para ser 'cachado' en otro lado y ser validado

        // $request = $request->withAttribute("csrf_status", false);
        // return $next($request, $response);
    });
    return $guard;
};

//--------------------------------
// CUSTOM
//--------------------------------

$container['RequestMiddleware'] = function(Container $container){
    return new Src\Middleware\RequestMiddleware;
};

$container['AuthMiddleware'] = function (Container $container){
    return new Src\Middleware\AuthMiddleware($container->get('JWT'));
};
