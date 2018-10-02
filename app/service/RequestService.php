<?php namespace App\Service;
/**
 * Created by PhpStorm.
 * User: Carlos R. Zuñiga
 * Date: 20/08/2018
 * Time: 04:26 PM
 */

use App\Includes\Responses;
use App\Exceptions\RequestException;
use App\Model\Dummy;
use App\Persistence\PersistenceSingleton;

class RequestService
{

    /**
     * @var \App\Persistence\PersistenceSingleton
     */
    private $persistence;

    public function __construct(){
        $this->persistence = PersistenceSingleton::getInstance();
    }

    /**
     * @return array
     * @throws RequestException
     */
    public function getAllPeople(){
        $res =  $this->persistence->getAll();
        if( empty( $res ) )
            throw new RequestException( Responses::NO_CONTENT, "There are not people" );

        return $res;
    }


    /**
     * @param $name String people name
     *
     * @return array|bool
     * @throws RequestException
     */
    public function getPeople_byName($name) {
        $res =  $this->persistence->searchPeople( $name );
        if( empty( $res ) )
            throw new RequestException( Responses::NOT_FOUND, "Name does not exist" );

        return $res;
    }

    /**
     * @param $people Dummy
     *
     * @return array
     */
    public function AddPeople( $people ){
        try {
            $res = $this->getPeople_byName( $people->getNames() );
            throw new RequestException( Responses::CONFLICT, "Name already exists" );
        } catch (RequestException $e) { /*  Nothing to do */ }

        $res =  $this->persistence->addPeople( $people );
        return $res;
    }


    /**
     * @param $name String people name
     *
     * @return array|bool
     * @throws RequestException
     */
    public function deletePeople($name) {
        $res =  $this->persistence->deletePeople( $name );
        if( !$res )
            throw new RequestException( Responses::NOT_FOUND, "Name does not exist" );

        return $res;
    }


}