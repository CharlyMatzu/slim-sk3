<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;

// using map for multiple methods
$app->map(['GET', 'POST'], '/', function (Request $request,  Response $response, $params = []) {
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

$app->any('/any', function (Request $request,  Response $response, $params = []) {
    return $response
        ->withStatus(200)
        ->write('ANY EXAMPLE FOR ALL METHODS');
});


// Simple New Route Function Signature
$app->get('/info[/]', function (Request $request,  Response $response, $params = []) {
    //GET EXTRA INFORMATION
    $route = $request->getAttribute('route');

    return $response
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
$app->get('/call/invoke', new \App\Controller\RequestController() );

// Use a custom callback controller using invoke method
$app->get('/call/class', \App\Controller\RequestController::class . ':classExample' );

// Use a custom callback controller using an specific method
// it need to be instanced on dependencies.php
$app->get('/call/method', 'RequestController:methodExample');



//------------ Middleware examples
// See more: http://www.slimframework.com/docs/v3/concepts/middleware.html

$app->get('/midd', function (Request $request, Response $response, $params = []) {
    return $response->write("MIDDLEWARE");
})->add('RequestMiddleware:testMiddleware');


$app->get('/midd/real', 'RequestController:checkExample')
    ->add('RequestMiddleware:checkBodyParams');
// { "name": "someone", "email": "someone@mail.com" }


// ----------- USING TWIG RENDER

$app->any('/view', function (Request $request,  Response $response, $params = []) {
    return $this->view
        ->render($response, 'home.twig', [
            'TITLE' => 'TEST',
            'NAMES' => ['Carlos', 'Roberto', 'Zuniga', 'Martinez']
        ]);
});



// ----------- USING GROUPS

$app->group('/group', function (App $app) {

    $app->any('/test', function (Request $request,  Response $response, $params = []) {
        return $response->write("using groups");
    });
});



// ----------- FILE UPLOAD
// NOTE: required multipart/form-data
$app->post('/file', function(Request $request,  Response $response, $params = []){
    //$directory = $this->get('upload_directory'); // settings.php
    $directory = ROOT_PATH . DS . 'public' . DS . 'uploads';
    if (!file_exists($directory)) mkdir( $directory, 0777, true);

    /** @var $uploadedFiles UploadedFile*/
    $uploadedFiles = $request->getUploadedFiles();
    /** @var $file UploadedFile*/
    $file = $uploadedFiles['some_image'];

    if ($file->getError() === UPLOAD_ERR_OK){
        $filename = moveUploadedFile($directory, $file);
        return $response->write($filename);
    }

    return $response->write("An error has ocurred");
});


function moveUploadedFile($directory, UploadedFile $uploadedFile)
{
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

    return $filename;
}
