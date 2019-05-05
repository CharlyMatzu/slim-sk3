<?php namespace App\Service;
/**
 * Created by PhpStorm.
 * User: Carlos R. Zuñiga
 * Date: 20/08/2018
 * Time: 04:26 PM
 */

use App\Exceptions\PersistenceException;
use App\Includes\Responses;
use App\Exceptions\RequestException;
use App\Model\User;
use App\Persistence\DummySingleton;


class RequestService
{

    /**
     * @var \App\Persistence\DummySingleton
     */
    private $persistence;

    public function __construct(){
        $this->persistence = DummySingleton::getInstance();
    }

    /**
     * @return array
     * @throws RequestException
     */
    public function getDummies(){
        try{
            $res = $this->persistence->getAll();
            if( empty( $res ) )
                throw new RequestException( Responses::NO_CONTENT, "There are not people" );

            return $res;
        } catch (PersistenceException $e) {
            throw new RequestException(Responses::INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }


    /**
     * @param $search
     * @return array|bool
     * @throws RequestException
     */
    public function getDummy_BySearch( $search ) {
        try{
            $res =  $this->persistence->searchDummy( $search );
            if( empty( $res ) )
                throw new RequestException( Responses::NO_CONTENT, "Dummies" );

            return $res;
        } catch (PersistenceException $e) {
            throw new RequestException(Responses::INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * @param $people User
     *
     * @return bool
     * @throws RequestException
     */
    public function AddPeople( $people ){
        try{
            return $this->persistence->addDummy( $people->getNames() );
        } catch (PersistenceException $e) {
            throw new RequestException(Responses::INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }


    /**
     * @param $id String people name
     *
     * @return bool
     * @throws RequestException
     */
    public function removeDummy($id ) {
        try{
            return $this->persistence->removeDummy_ById( $id );
        } catch (PersistenceException $e) {
            throw new RequestException(Responses::INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }


}