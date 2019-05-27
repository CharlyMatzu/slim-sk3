<?php namespace App\Exceptions;
use \Exception;

class RequestException extends Exception
{
    protected $statusCode;

    /**
     * RequestException constructor.
     * @param $statusCode int HTTP code response
     * @param $message String Exception Message
     */
    public function __construct($statusCode, $message)
    {
        parent::__construct($message);
        $this->statusCode = $statusCode;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }


}