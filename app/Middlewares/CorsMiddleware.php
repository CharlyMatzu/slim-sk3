<?php namespace App\Middlewares;


class CorsMiddleware extends BaseMiddleware
{
    /**
     * @param $request \Slim\Http\Request
     * @param $response \Slim\Http\Response
     * @param $next callable
     * @return mixed
     */
    function __invoke($request, $response, $next)
    {
        // TODO: probar
        // OPTIONS is the first preflight request in CORS
        // Allow or deny user-agent to access using Access-Control-Allow headers
        if( $request->getMethod() === 'OPTIONS' ) {
            return $response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
        }
        $response = $next($request, $response);
        return $response;
    }
}