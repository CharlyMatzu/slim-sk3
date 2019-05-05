<?php
/**
 * Created by PhpStorm.
 * User: Carlos R. Zuñiga
 * Date: 27/08/2018
 * Time: 09:28 AM
 */

use Slim\Http\Request;
use Slim\Http\Response;


//--------------f
// CORS Middleware
//--------------

// https://stackoverflow.com/questions/43871637/no-access-control-allow-origin-header-is-present-on-the-requested-resource-whe
// https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS#Preflighted_requests


// CORS
//$app->options('/{routes:.+}', function ($request, $response, $args) {
//    $res = \App\Includes\Responses::setCORStoResponse( $response );
//    return $res;
//});

// Main CORS Middleware
$app->add( function (Request $request, Response $response, $next) {
    //OPTIONS is the first preflight request in CORS
    //Allow or deny user-agent to access using Access-Control-Allow headers
    if( $request->getMethod() === 'OPTIONS' ) {
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    }

//    /**
//     * First add CORS to response before to next
//     * @var $res Slim\Http\Response;
//     */
//    $res = $response
//        ->withHeader('Access-Control-Allow-Origin', '*')
//        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
//        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');

    //Add CORS headers in all responses (works of this form)
    $res = \App\Utils\Responses::setCORStoResponse( $response );
    $res = $next($request, $res);
    return $res;
});


//--------------
// CUSTOM
//--------------
$container['RequestMiddleware'] = function($c){
    return new App\Middleware\RequestMiddleware();
};

//$container['myService'] = function ($container) {
//    $myService = new MyService();
//    return $myService;
//};