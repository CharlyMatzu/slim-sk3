<?php namespace App\controller;


use App\Exceptions\RequestException;
use App\Utils\Responses;
use Slim\Http\Request;
use Slim\Http\Response;

class UsersController extends BaseController
{
    /**
     * @param $request Request
     * @param $response Response
     * @param $params array
     * @return Response
     */
    public function getUsers(Request $request,  Response $response, $params = []){
//        try{
//            $res = $this->service->getDummies();
//            return $response
//                ->withStatus( Responses::OK )
//                ->withJson( $res );
//
//        }catch (RequestException $ex){
//            return $response
//                ->withStatus( $ex->getStatusCode() )
//                ->withJson( $ex->getMessage()  );
//        }
    }
}