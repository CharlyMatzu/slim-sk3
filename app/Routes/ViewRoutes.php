<?php

use Slim\Http\Request;
use Slim\Http\Response;


$app->get('/view', function (Request $request, Response $response, $params = []) use ($container){
    return $container->View
        ->render($response, 'home.twig', [
            'TITLE' => 'TEST',
            'NAMES' => ['Carlos', 'Roberto', 'Zuniga', 'Martinez']
        ]);
});