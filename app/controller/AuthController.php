<?php
/**
 * Created by PhpStorm.
 * User: Carlos R. Zuñiga
 * Date: 29/08/2018
 * Time: 04:32 PM
 */

namespace App\controller;


use App\Includes\Responses;
use App\Includes\Utils;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthController
{
    function __construct() {}


    /**
     * @param $request Request
     * @param $response Response
     * @param $params array
     * @return Response
     * @throws \Exception
     */
    public function auth($request, $response, $params = []){
        //TODO: validate data before to check

        //get params
        //TODO: check grant type
        $type = $params['grant_type'];
        //TODO: separate in other method
        $client = $params['client_id'];
        $secret = $params['client_secret'];

        //TODO: decript data

//        $file = file_get_contents(INCLUDES_PATH ."/creds.json");
//        if( !$file )
//            throw new \Exception("File doesn't exist");
//
//        $json = json_decode( $file );
//
//        if( $client === $json->client &&
//            $secret === $$json->secret )
//        {
//            //Generate token
//            return $response->withStatus( 200 )->write( "SomeTokenToUse" );
//        }

        if( $client === '111' && $secret === '123456' )
            return $response->withStatus( 200 )->write( Utils::$token_dummy );

        return $response->withStatus( Responses::$UNAUTHORIZED )->write( "No authorized" );
    }
}