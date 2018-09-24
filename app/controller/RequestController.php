<?php namespace App\Controller;

use App\Exceptions\PersistenceException;
use App\Exceptions\RequestException;
use App\Includes\Responses;
use App\Service\RequestService;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Created by PhpStorm.
 * User: Carlos R. Zuñiga
 * Date: 27/08/2018
 * Time: 04:43 PM
 */

class RequestController
{
    private $service;
    function __construct() {
        $this->service = new RequestService();
    }

    /**
     * @param $request Request
     * @param $response Response
     * @param $params array
     * @return Response
     */
    public function __invoke($request, $response, $params = []){
        return $response->withStatus( 200 )
                        ->withJson( "USING INVOKE"  );
    }

    /**
     * @param $request Request
     * @param $response Response
     * @param $params array
     * @return Response
     */
    public function methodExample($request, $response, $params = []){
        return $response->withStatus( 200 )
            ->withJson( "USING SPECIFIC METHOD"  );
    }

    /**
     * @param $request Request
     * @param $response Response
     * @param $params array
     * @return Response
     */
    public function getAllPeople($request, $response, $params = []){
        try{
            $res = $this->service->getAllPeople();
            return $response->withStatus( Responses::$OK )
                        ->withJson( $res );
        }catch (RequestException $ex){
            return $response->withStatus( $ex->getStatusCode() )
                        ->withJson( $ex->getMessage()  );
        }
    }


    /**
     * @param $request Request
     * @param $response Response
     * @param $params array
     * @return Response
     */
    public function getPeople($request, $response, $params = []){
        try{
            $name = $params['name'];
            $res = $this->service->getPeople_byName( $name );

            return $response->withStatus( Responses::$OK )
                ->withJson( $res );
        }catch (RequestException $ex){
            return $response->withStatus( $ex->getStatusCode() )
                ->withJson( $ex->getMessage()  );
        }
    }


    /**
     * @param $request Request
     * @param $response Response
     * @param $params array
     * @return Response
     */
    public function addPeople($request, $response, $params = []){
        try{
            $body = $request->getParsedBody();

            // getting body params
//            $name = $body['name'];
//            $email = $body['email'];
//            $date = $body['date'];
//            $age = $body['age'];
//            $address = $body['address'];


            // getting people object after middleware review
            $people = $request->getAttribute( 'people');
            $res = $this->service->AddPeople( $people );

            return $response->withStatus( Responses::$OK )
                ->withJson( "GetExample" );
        }catch (RequestException $ex){
            return $response->withStatus( $ex->getStatusCode() )
                ->withJson( $ex->getMessage()  );
        }
    }

}