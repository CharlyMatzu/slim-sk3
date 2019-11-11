<?php namespace Src\Controllers;

use Src\Utils\Base;
use Src\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;


class BasicController extends Base
{
    public function __invoke(Request $request,  Response $response, $params = []){
        return $response
            ->withStatus( 200 )
            ->withJson( "USING INVOKE"  );
    }


    public function classExample(Request $request,  Response $response, $params = []){
        return $response
            ->withStatus( 200 )
            ->withJson( "USING CLASS METHOD"  );
    }


    public function methodExample(Request $request,  Response $response, $params = []){
        return $response
            ->withStatus( 200 )
            ->withJson( "USING SPECIFIC METHOD"  );
    }


    public function checkExample(Request $request,  Response $response, $params = []){
        /**@var $user User*/
        $user = $request->getAttribute('user');

        return $response
            ->withStatus( 200 )
            ->withJson( "MIDDLEWARE CHECK USER " . $user->getName()   );
    }

}