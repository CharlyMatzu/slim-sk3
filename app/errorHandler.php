<?php

use App\Classes\FlatLogger;
use App\Classes\HttpUtils;
use Slim\Http\Request;
use Slim\Http\Response;


$container['errorHandler'] = function($container) {
    /**
     * @param $request \Slim\Http\Request
     * @param $response \Slim\Http\Response
     * @param $ex RuntimeException
     * @return mixed
     */
    return function ($request, $response, $ex) use ($container) {
        $container->Logger->makeErrorLog( "ErrorHandler: " );
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
        return $container->HttpUtils->makeMessageResponse( $response, HttpUtils::NOT_FOUND, "Route does not exist" );
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
            "Method not allowed. Must be one of: " . implode(',', $methods) );
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
        $container->Logger->makeErrorLog("PHPErrorHandler: ".$error);
        return $container->HttpUtils->makeMessageResponse( $response, HttpUtils::INTERNAL_SERVER_ERROR, "An internal error has occurred" );
    };
};

