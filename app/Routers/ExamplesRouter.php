<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

// using map for multiple methods
$app->map(['GET', 'POST'], '/', function (Request $req,  Response $res, $params = []) {
    return $res
        ->withStatus(200)
        ->write('HELLO WORLD USING MAP ROUTE EXAMPLE');
});

// Simple New Route Function Signature
$app->get('/get', function (Request $req,  Response $res, $params = []) {
    return $res->write('GET EXAMPLE');
});

$app->post('/post', function (Request $req,  Response $res, $params = []) {
    return $res->write('POST EXAMPLE');
});

$app->put('/put', function (Request $req,  Response $res, $params = []) {
    return $res->write('PUT EXAMPLE');
});

$app->any('/any', function (Request $req,  Response $res, $params = []) {
    return $res
        ->withStatus(200)
        ->write('ANY EXAMPLE FOR ALL METHODS');
});


// Simple New Route Function Signature
$app->get('/info[/]', function (Request $req,  Response $res, $params = []) {
    //GET EXTRA INFORMATION
    $route = $req->getAttribute('route');

    return $res
        ->withStatus(200)
        ->withJson([
            "name" => $route->getName(),
            "groups" => $route->getGroups(),
            "methods" => $route->getMethods(),
            "arguments" => $route->getArguments()
        ]);

})->setName("info route name"); //name for identification

// using URL param
$app->get('/hello/{name}', function( Request $request, Response $response, $params = [] ){
    return $response
        ->withStatus(200)
        ->write("HELLO ". $params['name']);
});

// using headers
$app->get('/headers/request', function (Request $req,  Response $res, $params = []) {
    $headers = $req->getHeaders();
    return $res
        ->withStatus(200)
        ->write( print_r($headers) );

});

$app->get('/headers/response', function (Request $req,  Response $res, $params = []) {
    return $res
        ->withStatus(200)
        ->withHeader('Authorization', 'value')
        ->write('Authorization header are included on Response');

});

// Redirect example
$app->redirect('/redirect[/]', 'redirect/example');

// Redirect using response argument
$app->get('/redirect/v2[/]', function (Request $req,  Response $res, $params = []) {
    return $res
        ->withRedirect('redirect/example', 301);

});

// redirected response
$app->get('/redirect/example', function (Request $req,  Response $res, $params = []) {
    return $res
        ->withStatus( 200 )
        ->write("Redirected");

});

// Use a custom callback controller using invoke method
$app->get('/call/invoke', new \App\Controller\RequestController() );

// Use a custom callback controller using invoke method
$app->get('/call/class', \App\Controller\RequestController::class . ':classExample' );

// Use a custom callback controller using an specific method
// it need to be instanced on dependencies.php
$app->get('/call/method', 'RequestController:methodExample');



//------------ Middleware examples
// See more: http://www.slimframework.com/docs/v3/concepts/middleware.html

$app->get('/midd', function (Request $req,  Response $res, $params = []) {
    return $res->write("MIDDLEWARE");
})->add('RequestMiddleware:testMiddleware');


$app->get('/midd/real', 'RequestController:checkExample')
    ->add('RequestMiddleware:checkBodyParams');
// { "name": "someone", "email": "someone@mail.com" }


// ----------- USING TWIG RENDER

$app->any('/view', function (Request $req,  Response $res, $params = []) {
    return $this->view
        ->render($res, 'home.twig', [
            'TITLE' => 'TEST',
            'NAMES' => ['Carlos', 'Roberto', 'Zuniga', 'Martinez']
        ]);
});



// ----------- USING GROUPS

$app->group('/group', function (App $app) {

    $app->any('/test', function (Request $req,  Response $res, $params = []) {
        return $res->write("using groups");
    });
});