<?php
/**
 * Created by PhpStorm.
 * User: Carlos R. Zuñiga
 * Date: 27/08/2018
 * Time: 09:19 AM
 */

use Slim\Http\Request;
use Slim\Http\Response;



//--------------------------
// EXAMPLES
//--------------------------

/**
 * BASIC ENDPOINT SETUP
 * Using Slim\App instance to handle a GET, POST, PUT.... Request
 * determine type request and set 2 params like the next example:
 *      $app->request( pattern, callback ){}
 * Request: can be GET, POST, PUT, PATH, OPTIONS, e
 * pattern: is the uri path to use to handle the request, example '/', '/hello', '/hello/world/'
 * callback: is a callable function that will be called to handle the request,  this callback receive a
 * 2 or 3 params depending of the pattern. Params are
 *      Slim\Http\Request: Contain a Header, uri (route)
 *      Slim\Http\Response:
 *      array[]:
 */

//-------- MIDDLEWARE
// TODO: organize this comments

//// Using a global middleware
//// using with a function
//$app->add(function (Request $req,  Response $res, callable $next) {
//    // Do stuff before passing along
//    $newResponse = $next($req, $res);
//    // Do stuff after route is rendered
//    return $newResponse; // continue
//});
//
////this
//$app->add(new \App\Middleware\RequestMiddleware());
//// or
//$app->add(\App\Middleware\RequestMiddleware::class);
//
//// using a specific method
//// need to be instanced on middleware.php
//$app->add( 'RequestMiddleware:example' );
//
//// making a chain
//// call order is LIFE (Last In First Executed)
//$app->add( 'RequestMiddleware:example' )->add( 'RequestMiddleware:example' )->add( 'RequestMiddleware:example' );






//--------------- BASIC ROUTES

// Simple New Route Function Signature
$app->get('/', function (Request $req,  Response $res, $args = []) {
    return $res
        ->withStatus(200)
        ->write('HELLO WORLD');

}); //name for identification


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

// Use a custom callback controller using an specific method
// it need to be instanced on dependencies.php
$app->get('/call/method', 'RequestController:methodExample');


// using URL param
$app->get('/hello/{name}', function( Request $request, Response $response, $args = [] ){
    return $response
        ->withStatus(200)
        ->write("HELLO ". $args['name']);
});




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


