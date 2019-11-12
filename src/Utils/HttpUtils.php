<?php namespace Src\Utils;

use Slim\Http\Response;
use \Slim\Container;



class HttpUtils
{
    const OK = 200;
    const CREATED = 201;
    const NO_CONTENT = 204;
    const MOVED_PERMANENTLY = 301;
    const TEMPORARY_REDIRECT = 307;
    const PERMANENT_REDIRECT = 308;
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const METHOD_NOT_ALLOWED = 405;
    const CONFLICT = 409;
    const LENGTH_REQUIRED = 411;
    const INTERNAL_SERVER_ERROR = 500;


    /**
     * @param $response Response
     * @param $statusCode int HTTP response status code
     * @see HttpUtils
     * @see HttpUtils::OK
     * @param $message String message for response
     * @return Response
     */
    public function getJsonResponse($response, $statusCode, $message, $data = null){
        return $response
            ->withStatus( $statusCode )
            ->withHeader( 'Content-Type', 'application/json' )
            ->withJson(
                [
                    'code' => $statusCode,
                    'message' => $message,
                    'data' => $data,
                ]
            );
    }

}