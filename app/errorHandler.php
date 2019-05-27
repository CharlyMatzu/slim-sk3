<?php

use App\Classes\HttpUtils;


$container['errorHandler'] = function($container) {
    /**
     * @param $request \Slim\Http\Request
     * @param $response \Slim\Http\Response
     * @param $ex RuntimeException
     * @return mixed
     */
    return function ($request, $response, $ex) use ($container) {
        $container->Logger->makeErrorLog( 'ErrorHandler: ', $ex);
        return $container->HttpUtils->makeMessageResponse($response, HttpUtils::INTERNAL_SERVER_ERROR, "Something went wrong");
    };
};


//Override the default Not Found Handler
$container['notFoundHandler'] = function ($container) {
    /**
     * @param $request \Slim\Http\Request
     * @param $response \Slim\Http\Response
     * @return \Slim\Http\Response
     */
    return function ($request, $response) use ($container) {
        $uri = $request->getUri();
        $url = $uri->getBaseUrl()."/".$uri->getPath();
        $message = 'Route does not exist - ' .$request->getMethod().": ".$url;
        return $container->HttpUtils->makeMessageResponse( $response, HttpUtils::NOT_FOUND, $message );
    };
};


// Override the default Not Found Handler
$container['notAllowedHandler'] = function ($container) {
    /**
     * @param $request \Slim\Http\Request
     * @param $response \Slim\Http\Response
     * @param $methods array
     * @return \Slim\Http\Response
     */
    return function ($request, $response, $methods) use ($container) {
        return $container->HttpUtils->makeMessageResponse(
            $response,
            HttpUtils::METHOD_NOT_ALLOWED,
            'Method '.$request->getMethod().' not allowed. Must be one of: ' . implode(',', $methods) );
    };
};



$container['phpErrorHandler'] = function ($container) {
    /**
     * @param $request \Slim\Http\Request
     * @param $response \Slim\Http\Response
     * @param $error
     * @return \Slim\Http\Response
     */
    return function ($request, $response, $error) use ($container) {
        $container->Logger->makeErrorLog('PHPErrorHandler: '.$error);
        return $container->HttpUtils->makeMessageResponse( $response, HttpUtils::INTERNAL_SERVER_ERROR, 'Something went wrong' );
    };
};

