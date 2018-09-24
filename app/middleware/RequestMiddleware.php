<?php namespace App\Middleware;
use App\Includes\Responses;
use App\Includes\Utils;
use App\Model\People;
use Slim\Http\Request;
use Slim\Http\Response;


/**
 * Created by PhpStorm.
 * User: Carlos R. Zuñiga
 * Date: 27/08/2018
 * Time: 09:28 AM
 */

class RequestMiddleware
{
    function __construct() {}

    /**
     * @param $request Request
     * @param $response Response
     * @param $next callable (next middleware or controller to call)
     * @return Response
     */
    public function __invoke($request, $response, $next){
        $res = $next($request, $response);
        return $res;
    }

    /**
     * @param $request Request
     * @param $response Response
     * @param $next callable (next middleware or controller to call)
     * @return Response
     */
    public function checkBodyParams($request, $response, $next){
        $body = $request->getParsedBody();

        // also can use $request->getQueryParams()['myParam']

        if( empty( $body ) )
            return $response->withStatus( Responses::$BAD_REQUEST )->write( "Missing params" );

        $name = $body['name'];
        $email = $body['email'];
        $date = $body['date'];
        $age = $body['age'];
        $address = $body['address'];

        if( empty( $name ) || empty( $email ) || empty( $date ) || empty( $age ) || empty( $address ) )
            return $response->withStatus( Responses::$BAD_REQUEST )->write( "Empty params" );

        $people = new People( $name, $date, $age, $email, $address );

        // sharing a object in the app with request
        $request = $request->withAttribute( 'people', $people);

        // Call next callable method
        $res = $next($request, $response);
        return $res;
    }


//    /**
//     * @param $request Request
//     * @param $response Response
//     * @param $next callable (next middleware or controller to call)
//     * @return Response
//     */
//    public function authHeader($request, $response, $next){
//        $header = $request->getHeader('Authorization');
//        if( empty($header) )
//            return $response->withStatus( Responses::$UNAUTHORIZED )->write("Missing Authorization header" );
//
//        if( $header[0] !== Utils::$token_dummy )
//            return $response->withStatus( Responses::$UNAUTHORIZED )->write("Access Denied, Invalid Access Token (Test)" );
//
//        $res = $next($request, $response);
//        return $res;
//    }


}