<?php namespace App\Middlewares;

use Slim\Http\Request;
use Slim\Http\Response;


class RequestMiddleware extends BaseMiddleware
{
    /**
     * @param $request Request
     * @param $response Response
     * @param $next
     * @return mixed
     */
    public function testMiddleware($request, $response, $next){
        $response->getBody()->write('BEFORE ');
        $response = $next($request, $response);
        $response->getBody()->write(' AFTER');
        return $response;
    }



    //-------- Real middleware  example

    /**
     * @param $request Request
     * @param $response Response
     * @param $next callable
     * @return Response
     */
    public function checkBodyParams($request, $response, $next){
        $body = $request->getParsedBody();

        // also can use $request->getQueryParams()['myParam']

        if( empty( $body ) )
            return $response->withStatus( HttpUtils::BAD_REQUEST )->write( "Missing params" );

        $name = $body['name'];
        $email = $body['email'];

        if( empty( $name ) || empty( $email ))
            return $response->withStatus( HttpUtils::BAD_REQUEST )->write( "Empty params" );

        $user = new UserEntity( $name, $email);

        // sharing a object in the app with request
        $request = $request->withAttribute( 'user', $user);

        // Call next callable method
        $response = $next($request, $response);
        return $response;
    }


}