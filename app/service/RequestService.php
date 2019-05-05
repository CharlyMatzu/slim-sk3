<?php namespace App\Service;
/**
 * Created by PhpStorm.
 * User: Carlos R. Zuñiga
 * Date: 20/08/2018
 * Time: 04:26 PM
 */

use App\Exceptions\PersistenceException;
use App\Utils\Responses;
use App\Exceptions\RequestException;
use App\Model\User;


class RequestService
{

    /**
     * @param $user User
     * @return mixed
     * @throws RequestException
     */
    public function testService($user){
        try{
            $res = $this->persistence->getAll();
            if( empty( $res ) )
                throw new RequestException( Responses::NO_CONTENT, "There are not people" );

            return $res;
        } catch (PersistenceException $e) {
            throw new RequestException(Responses::INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

}