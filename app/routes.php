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
// ENDPOINTS
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



//--------------- BASIC ROUTES

// Simple New Route Function Signature
$app->get('/', function (Request $req,  Response $res, $args = []) {
    return $res->withStatus(200)->write('HELLO WORLD');
});

//// get the current route
//$app->get('/current', function (Request $req,  Response $res, $args = []) {
//    $route = $req->getAttribute('route');
//    return $res->withStatus(200)->write( ... );
//});


// using headers
$app->get('/header', function (Request $req,  Response $res, $args = []) {
    return $res->withStatus(200)->withHeader('Authorization', 'value')->write('HELLO WORLD USING HEADER');
});

// Redirect example
$app->redirect('/redirect', 'https://www.mywebsite.com');

// Redirect using response argument
$app->get('/redirect/v2', function (Request $req,  Response $res, $args = []) {
    return $res->withRedirect('http://localhost/slim-skeleton/redirect/example', 301);
});

// Redirect using response argument
$app->get('/redirect/example', function (Request $req,  Response $res, $args = []) {
    return $res->withStatus( 200 )->write("Redirected");
});

// Use a custom callback controller using invoke method
$app->get('/invoke', new App\Controller\RequestController() );

// Use a custom callback controller using an specific method
// it need to be instanced on dependencies.php
$app->get('/method', 'RequestController:methodExample');


//--------------- USING VERBS WITH SERVICES

$app->get('/people', 'RequestController:getAllPeople');

$app->get('/people/{name}', 'RequestController:getPeople');

// using middleware
$app->post('/people', 'RequestController:addPeople')
        ->add( 'RequestMiddleware:checkBodyParams' );

$app->delete('/people/{name}', 'RequestController:deletePeople');

/*
 * POST Request - JSON example for add people
    {
        "name": "Carlos Zuñiga",
        "age": 24,
        "email": "charly@mail.com",
        "address": "some address"
    }
*/



//--------------- MIDDLEWARE


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




//------------ GROUPS
$app->group('/v1', function () {
    //route 'v1'
    $this->get('[/]', function (Request $req,  Response $res, $args = []) {
        return $res->withStatus(200)->withJson( "This is a root of URI group" );
    });

});