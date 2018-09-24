<?php
/**
 * Created by PhpStorm.
 * User: Carlos R. Zuñiga
 * Date: 27/08/2018
 * Time: 09:24 AM
 */

use App\includes\FlatLogger;
use App\Includes\Responses;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * CORS middleware does execute when and error occurs, is required add cors in response in error handlers
 */

$container['errorHandler'] = function($c) {
    /**
     * @param $request \Slim\Http\Request
     * @param $response \Slim\Http\Response
     * @param $ex RuntimeException
     * @return mixed
     */
    return function ($request, $response, $ex) use ($c) {
        $res = \App\Includes\Responses::setCORStoResponse($response);
        FlatLogger::makeErrorLog( "ErrorHandler: ".$ex->getFile()."[".$ex->getLine()."] --- ".$ex->getMessage() ." --- Trace: ". $ex->getTraceAsString() );

        return Responses::makeMessageResponse($res, Responses::INTERNAL_SERVER_ERROR, "Something went wrong");
    };
};


//Override the default Not Found Handler
$container['notFoundHandler'] = function ($c) {
    /**
     * @param $request \Slim\Http\Request
     * @param $response \Slim\Http\Response
     * @return \Slim\Http\Response
     */
    return function ($request, $response) use ($c) {
        $res = \App\Includes\Responses::setCORStoResponse($response);
        return Responses::makeMessageResponse( $res, Responses::NOT_FOUND, "Route does Not exist" );
    };
};


// Override the default Not Found Handler
$container['notAllowedHandler'] = function ($c) {
    /**
     * @param $request \Slim\Http\Request
     * @param $response \Slim\Http\Response
     * @param $methods array
     * @return \Slim\Http\Response
     */
    return function (Request $request, Response $response, $methods) use ($c) {
        $res = \App\Includes\Responses::setCORStoResponse($response);
        return Responses::makeMessageResponse(
            $res,
            Responses::METHOD_NOT_ALLOWED,
            "Method not allowed. Must be one of: " . implode(',', $methods) );
    };
};



$container['phpErrorHandler'] = function ($c) {
    /**
     * @param $request \Slim\Http\Request
     * @param $response \Slim\Http\Response
     * @param $error
     * @return \Slim\Http\Response
     */
    return function ($request, $response, $error) use ($c) {
        $res = \App\Includes\Responses::setCORStoResponse($response);
        \App\includes\FlatLogger::makeErrorLog("PHPErrorHandler: ".$error);
        return Responses::makeMessageResponse( $res, Responses::INTERNAL_SERVER_ERROR, "An internal error has occurred" );
    };
};

