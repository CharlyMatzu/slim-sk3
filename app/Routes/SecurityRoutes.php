<?php

use Slim\App;
use Slim\Csrf\Guard;
use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/csrf', function (App $app) use ($container){

    $app->get('', function (Request $req, Response $res, $args) use ($container){
        $view = $container->get('View');
        /**@var Guard $csrf*/
        $csrf = $container->get('CSRF');

        // Key values
        $nameKey  = $csrf->getTokenNameKey();
        $valueKey = $csrf->getTokenValueKey();
        // token values
        $name     = $csrf->getTokenName();
        $value    = $csrf->getTokenValue();

        return $view
            ->render($res, 'csrf.twig', [
                'key' => [
                    'name'  => $nameKey,
                    'value' => $valueKey
                ],
                'name'  => $name,
                'value' => $value
            ]);
    })->add('CSRF');

    
    $app->post('', function (Request $req, Response $res, $args) use ($container){
        return $res->write('Passed CSRF check.');
    })->setName('csrf-test')->add('CSRF');

    //NOTA: En este caso ambas rutas utilizan el Middleware, es necesario que la ruta que lo genera lo tenga
    // ya que la primera ocasión no existirá un token, debe generarse. Adicionalmente se puede asignar el middleware
    // a las rutas de interés o de forma global.

});

// $app->get('/token', function(Request $req, Response $res, $args){
//     return $res->write('token');
// });

// $app->group('/jwt', function(App $app) use ($container){
    
//     $app->get('/token', function(Request $req, Response $res, $args){
//         return $res->write('token');
//     });

//     $app->get('/protected', function(Request $req, Response $res, $args){
//         return $res->write(json_encode($args));
//     });

//     // $app->post('/protected', function(Request $req, Response $res, $args){
        
//     // });
// });