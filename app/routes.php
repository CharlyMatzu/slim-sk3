<?php
/**
 * Created by PhpStorm.
 * User: Carlos R. Zuñiga
 * Date: 27/08/2018
 * Time: 09:19 AM
 */

use Slim\Http\Request;
use Slim\Http\Response;


// using map for multiple methods
$app->map(['GET', 'POST'], '/', function (Request $req,  Response $res, $args = []) {
    return $res
        ->withStatus(200)
        ->write('HELLO WORLD USING MAP ROUTE EXAMPLE');
});

// Simple New Route Function Signature
$app->get('/get', function (Request $req,  Response $res, $args = []) {
    return $res->write('GET EXAMPLE');
});

$app->post('/post', function (Request $req,  Response $res, $args = []) {
    return $res->write('POST EXAMPLE');
});

$app->put('/put', function (Request $req,  Response $res, $args = []) {
    return $res->write('PUT EXAMPLE');
});

$app->any('/any', function (Request $req,  Response $res, $args = []) {
    return $res
        ->withStatus(200)
        ->write('ANY EXAMPLE FOR ALL METHODS');
});


// Simple New Route Function Signature
$app->get('/info[/]', function (Request $req,  Response $res, $args = []) {
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
$app->get('/hello/{name}', function( Request $request, Response $response, $args = [] ){
    return $response
        ->withStatus(200)
        ->write("HELLO ". $args['name']);
});

// using headers
$app->get('/headers/request', function (Request $req,  Response $res, $args = []) {
    $headers = $req->getHeaders();
    return $res
        ->withStatus(200)
        ->write( print_r($headers) );

});

$app->get('/headers/response', function (Request $req,  Response $res, $args = []) {
    return $res
        ->withStatus(200)
        ->withHeader('Authorization', 'value')
        ->write('Authorization header are included on Response');

});

// Redirect example
$app->redirect('/redirect[/]', 'redirect/example');

// Redirect using response argument
$app->get('/redirect/v2[/]', function (Request $req,  Response $res, $args = []) {
    return $res
        ->withRedirect('redirect/example', 301);

});

// redirected response
$app->get('/redirect/example', function (Request $req,  Response $res, $args = []) {
    return $res
        ->withStatus( 200 )
        ->write("Redirected");

});

// Use a custom callback controller using invoke method
$app->get('/call/invoke', new App\Controller\RequestController() );

// Use a custom callback controller using invoke method
$app->get('/call/class', App\Controller\RequestController::class . ':classExample' );

// Use a custom callback controller using an specific method
// it need to be instanced on dependencies.php
$app->get('/call/method', 'RequestController:methodExample');



//------------ Middleware examples
// See more: http://www.slimframework.com/docs/v3/concepts/middleware.html

$app->get('/midd', function (Request $req,  Response $res, $args = []) {
    return $res->write("MIDDLEWARE");
})->add('RequestMiddleware:testMiddleware');


$app->get('/midd/real', 'RequestController:checkExample')
    ->add('RequestMiddleware:checkBodyParams');
/*
    {
        "name": "someone",
        "email": "someone@mail.com"
    }
*/


// -------------------------
// USING GROUPS AND DUMMY DATA
// -------------------------

// heredoc syntax  -->  http://php.net/manual/es/language.types.string.php#language.types.string.syntax.heredoc
$welcome = <<<EOD
Welcome to the PHP-slim-skeleton
We'll use a CSV file with useful
data for this example of Rest API.
EOD;

$app->group('/dummy', function () {
    //-----------------------ENDPOINTS
    $this->get('[/]', 'RequestController:');
});


