<?php namespace App\Exceptions;
use App\Includes\Responses;

/**
 * Created by PhpStorm.
 * User: Carlos R. Zuñiga
 * Date: 20/08/2018
 * Time: 04:26 PM
 */


class PersistenceException extends RequestException
{
    /**
     * PersistenceException constructor.
     * @param $message String
     */
    public function __construct($message)
    {
        parent::__construct( Responses::$INTERNAL_SERVER_ERROR, $message);
    }
}