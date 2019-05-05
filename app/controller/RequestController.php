<?php namespace App\Controller;

use App\Exceptions\RequestException;
use App\Utils\Responses;
use App\Model\User;
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
        return $response
            ->withStatus( 200 )
            ->withJson( "USING INVOKE"  );
    }

    /**
     * @param $request Request
     * @param $response Response
     * @param $params array
     * @return Response
     */
    public function classExample($request, $response, $params = []){
        return $response
            ->withStatus( 200 )
            ->withJson( "USING CLASS METHOD"  );
    }

    /**
     * @param $request Request
     * @param $response Response
     * @param $params array
     * @return Response
     */
    public function methodExample($request, $response, $params = []){
        return $response
            ->withStatus( 200 )
            ->withJson( "USING SPECIFIC METHOD"  );
    }

    /**
     * @param $request Request
     * @param $response Response
     * @param $params array
     * @return Response
     */
    public function checkExample($request, $response, $params = []){
        /**@var $user User*/
        $user = $request->getAttribute('user');

        return $response
            ->withStatus( 200 )
            ->withJson( "MIDDLEWARE CHECK USER " . $user->getName()   );
    }

    //------------------------
    // DUMMY
    //------------------------

    /**
     * @param $request Request
     * @param $response Response
     * @param $params array
     * @return Response
     */
    public function getDummies($request, $response, $params = []){
        try{
            $res = $this->service->getDummies();
            return $response
                ->withStatus( Responses::OK )
                ->withJson( $res );

        }catch (RequestException $ex){
            return $response
                ->withStatus( $ex->getStatusCode() )
                ->withJson( $ex->getMessage()  );
        }
    }



}