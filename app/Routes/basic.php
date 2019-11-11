<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

$app->options('/{routes:.+}', function (Request $request, Response $response, $args) {
    return $response;
});

$app->map(['GET', 'POST'], '/', function (Request $request, Response $response, $params = []) {
    return $response
        ->withStatus(200)
        ->write('HELLO WORLD USING MAP ROUTE EXAMPLE');
});

// Simple New Route Function Signature
$app->get('/get', function (Request $request,  Response $response, $params = []) {
    return $response->write('GET EXAMPLE');
});

$app->post('/post', function (Request $request,  Response $response, $params = []) {
    return $response->write('POST EXAMPLE');
});

$app->put('/put', function (Request $request,  Response $response, $params = []) {
    return $response->write('PUT EXAMPLE');
});

$app->map(['POST', 'PUT'], '/body', function (Request $request,  Response $response, $params = []){
    $body = $request->getParsedBody();
    return $response
        ->withStatus(200)
        ->withJson($body);
});


// Simple New Route Function Signature
$app->get('/info[/]', function (Request $request,  Response $response, $params = []) {
    //GET EXTRA INFORMATION
    $route = $request->getAttribute('route');

    return $response
        ->withStatus(200)
        ->withJson([
            "URL"       => $_SERVER['REQUEST_URI'],
            "pattern"   => $route->getPattern(),
            "name"      => $route->getName(),
            "groups"    => $route->getGroups(),
            "methods"   => $route->getMethods(),
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
$app->get('/headers/request', function (Request $request,  Response $response, $params = []) {
    $headers = $request->getHeaders();
    return $response
        ->withStatus(200)
        ->write( print_r($headers) );

});

$app->get('/headers/response', function (Request $request,  Response $response, $params = []) {
    return $response
        ->withStatus(200)
        ->withHeader('Authorization', 'value')
        ->write('Authorization header are included on Response');

});

// Redirect example
$app->redirect('/redirect[/]', 'redirect/example');

// Redirect using response argument
$app->get('/redirect/v2[/]', function (Request $request,  Response $response, $params = []) {
    return $response
        ->withRedirect('redirect/example', 301);

});

// redirected response
$app->get('/redirect/example', function (Request $request,  Response $response, $params = []) {
    return $response
        ->withStatus( 200 )
        ->write("Redirected");

});

// Use a custom callback controller using invoke method
 $app->get('/call/invoke', \Src\Controllers\BasicController::class);

// Use a custom callback controller using invoke method
$app->get('/call/class', \Src\Controllers\BasicController::class . ':classExample' );

// Use a custom callback controller using an specific method
// it need to be instanced on Dependencies.php
$app->get('/call/method', 'BasicController:methodExample');

//------------ Middleware examples
// See more: http://www.slimframework.com/docs/v3/concepts/middleware.html

$app->get('/midd', function (Request $request, Response $response, $params = []) {
    return $response->write("MIDDLEWARE");
})->add('RequestMiddleware:testMiddleware');


$app->get('/midd/real', 'BasicController:checkExample')
    ->add('RequestMiddleware:checkBodyParams');
// { "name": "someone", "email": "someone@mail.com" }


// ----------- FILE UPLOAD
// NOTE: required multipart/form-data
$app->post('/file', function(Request $request,  Response $response, $params = []) use ($container){
    //$directory = $this->get('upload_directory'); // settings.php
    $directory = ROOT_PATH . DS . 'public' . DS . 'uploads';
    if (!file_exists($directory)) mkdir( $directory, 0777, true);

    /** @var $uploadedFiles UploadedFile*/
    $uploadedFiles = $request->getUploadedFiles();
    /** @var $file UploadedFile*/
    $file = $uploadedFiles['some_image'];

    if ($file->getError() === UPLOAD_ERR_OK){
        $filename = $container->File->moveUploadedFile($directory, $file); // TODO: check
        return $response->write($filename);
    }

    return $response->write("An error has ocurred");
});

// --------------- Groups
$app->group('/foo', function (App $app) use ($container){
    $app->get('', function (Request $req, Response $res, $args){
        return $res->write('foo');
    });

    $app->get('/bar', function (Request $req, Response $res, $args){
        return $res->write('foo bar');
    });
});