<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Src\Utils\HttpUtils;
use \Slim\Container;


// //Override the default Not Found Handler
$container['notFoundHandler'] = function (Container $container) {
    return function (Request $request, Response $response) use ($container) {
        $uri = $request->getUri();
        $url = $uri->getBaseUrl()."/".$uri->getPath();
        $jwt = $container->get('JWT');

        $message = 'No existe ruta - ' .$request->getMethod().": ".$url;
        // $response->write(print_r($container));
        return $container->HttpUtils->getJsonResponse($response, 404, $message );
    };
};


// Override the default Not Found Handler
// $container['notAllowedHandler'] = function (Container $container) {
//     return function (Request $request, Response $response, $methods) use ($container) {
//         $httpUtils = $container->get('HttpUtils');

//         return $httpUtils->makeMessageResponse(
//             $response,
//             HttpUtils::METHOD_NOT_ALLOWED,
//             'Method '.$request->getMethod().' not allowed. Must be one of: ' . implode(',', $methods) );
//     };
// };



// $container['phpErrorHandler'] = function (Container $container) {
//     return function (Request $request, Response $response, $error) use ($container) {
//         $httpUtils = $container->get('HttpUtils');
//         $logger = $container->get('Logger');

//         $logger->AddError('PHPErrorHandler: '.$error);
//         return $httpUtils->makeMessageResponse( $response, HttpUtils::INTERNAL_SERVER_ERROR, 'Something went wrong' );
//     };
// };

//$container['errorHandler'] = function(Container $container) {
//    return function (Request $request, Response $response, Exception $ex) use ($container) {
//        $container->Logger->makeErrorLog( 'ErrorHandler: ', $ex);
//        return $container->HttpUtils->makeMessageResponse($response, HttpUtils::INTERNAL_SERVER_ERROR, "Something went wrong");
//    };
//};