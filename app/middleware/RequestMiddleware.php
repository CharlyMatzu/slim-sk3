<?php namespace App\Middleware;
use App\Utils\Responses;
use App\Utils\Utils;
use App\Entities\UserEntity;
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
     * @param Request $request
     * @param Response $response
     * @param $next
     * @return mixed
     */
    public function testMiddleware(Request $request, Response $response, $next){
        $response->getBody()->write('BEFORE ');
        $response = $next($request, $response);
        $response->getBody()->write(' AFTER');
        return $response;
    }



    //-------- Real middleware  example

    /**
     * @param $request Request
     * @param $response Response
     * @param $next callable (next middleware or controller to call)
     * @return Response
     */
    public function checkBodyParams(Request $request, Response $response, $next){
        $body = $request->getParsedBody();

        // also can use $request->getQueryParams()['myParam']

        if( empty( $body ) )
            return $response->withStatus( Responses::BAD_REQUEST )->write( "Missing params" );

        $name = $body['name'];
        $email = $body['email'];

        if( empty( $name ) || empty( $email ))
            return $response->withStatus( Responses::BAD_REQUEST )->write( "Empty params" );

        $user = new UserEntity( $name, $email);

        // sharing a object in the app with request
        $request = $request->withAttribute( 'user', $user);

        // Call next callable method
        $response = $next($request, $response);
        return $response;
    }


}