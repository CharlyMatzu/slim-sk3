<?php

use Slim\Container;
use Slim\Csrf\Guard;
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

//--------------------------------
// Security
//--------------------------------

// --------- CSRF Protection Middleware
// Se generan un nuevo token ya que de inicio este no lo tiene
// generalmente se general al llamar '_invoke'
//$guard = new Guard();
//$guard->setPersistentTokenMode(true);
//$guard->generateToken();

// Register Middleware To Be Executed On All Routes
//$app->add('CSRF');

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

$container['JWT'] = function (Container $container){

};

//--------------------------------
// CUSTOM
//--------------------------------

$container['RequestMiddleware'] = function($container){
    return new Src\Middleware\RequestMiddleware;
};
