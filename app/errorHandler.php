<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Src\Classes\HttpUtils;
use \Slim\Container;


//Override the default Not Found Handler
$container['notFoundHandler'] = function (Container $container) {
    return function (Request $request, Response $response) use ($container) {
        $uri = $request->getUri();
        $url = $uri->getBaseUrl()."/".$uri->getPath();
        $message = 'Route does not exist - ' .$request->getMethod().": ".$url;
        return $container->HttpUtils->makeMessageResponse( $response, HttpUtils::NOT_FOUND, $message );
    };
};


// Override the default Not Found Handler
$container['notAllowedHandler'] = function (Container $container) {
    return function (Request $request, Response $response, $methods) use ($container) {
        return $container->HttpUtils->makeMessageResponse(
            $response,
            HttpUtils::METHOD_NOT_ALLOWED,
            'Method '.$request->getMethod().' not allowed. Must be one of: ' . implode(',', $methods) );
    };
};



$container['phpErrorHandler'] = function (Container $container) {
    return function (Request $request, Response $response, $error) use ($container) {
        $container->Logger->makeErrorLog('PHPErrorHandler: '.$error);
        return $container->HttpUtils->makeMessageResponse( $response, HttpUtils::INTERNAL_SERVER_ERROR, 'Something went wrong' );
    };
};

//$container['errorHandler'] = function(Container $container) {
//    return function (Request $request, Response $response, Exception $ex) use ($container) {
//        $container->Logger->makeErrorLog( 'ErrorHandler: ', $ex);
//        return $container->HttpUtils->makeMessageResponse($response, HttpUtils::INTERNAL_SERVER_ERROR, "Something went wrong");
//    };
//};