<?php

use Slim\App;
use Slim\Csrf\Guard;
use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/csrf', function (App $app) use ($container){

    $app->get('', function (Request $req, Response $res, $args) use ($container){
        /**@var Guard $csrf*/
        $view = $container->get('View');
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

    //NOTA: En este caso ambas rutas utilizan el Middleware, es necesario que la ruta que lo genera lo tenga
    // ya que la primera ocasión no existirá un token, debe generarse. Adicionalmente se puede asignar el middleware
    // a las rutas de interés o de forma global.
    $app->post('', function (Request $req, Response $res, $args) use ($container){
        return $res->write('Passed CSRF check.');
    })->setName('csrf-test')->add('CSRF');

});