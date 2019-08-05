<?php namespace Src\Classes;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class FlatLogger
 * Use for simple log creation
 * @see https://github.com/Seldaek/monolog
 * @see https://github.com/Seldaek/monolog/blob/master/doc/02-handlers-formatters-processors.md
 * @see https://stackify.com/php-monolog-tutorial/
 *
 * @package Src\classes
 */
class FlatLogger
{

    /*
        As illustrated in RFC 5424 which describes the syslog protocol, the following levels of intensity are applied in Monolog.

        DEBUG:      Detailed debugging information.
        INFO:       Handles normal events. Example: SQL logs
        NOTICE:     Handles normal events, but with more important events
        WARNING:    Warning status, where you should take an action before it will become an error.
        ERROR:      Error status, where something is wrong and needs your immediate action
        CRITICAL:   Critical status. Example: System component is not available
        ALERT:      Immediate action should be exercised. This should trigger some alerts and wake you up during night time.
        EMERGENCY:  It is used when the system is unusable.

    */

    /**
     * Create a logger depending of the type
     * NOTE: Require write permission
     * @param $path String path of the log
     * @param $type int level type, @see Logger::INFO
     * @param $message String log description
     * @param $extra String Extra information
     */
    private function makeLog($path, $type, $message, $extra){

        // file name using current date
        $log_name = date("Y-m-d" );
        $file = $path . "/" . $log_name . ".log";

        try {
            $log = new Logger( 'Logger' );
            $log->pushHandler(new StreamHandler($file, $type));
            $logMessage = $message ." ". $extra;

            switch ( $type ){
                case Logger::INFO:  $log->addInfo($logMessage); break;
                case Logger::ERROR: $log->addError($logMessage); break;
                case Logger::DEBUG: $log->addDebug($logMessage); break;

                default: $log->addInfo($logMessage);
            }

        } catch (\Exception $e) {
            // TODO: Use alternative logger using function file_put_contents()
            // file_put_contents( $file, "probando\r\n", FILE_APPEND );
        }
    }

    /**
     * Use for Critical Error Logging
     * @param $message String log description
     * @param $ex \Exception
     * @param $data String
     */
    public function makeErrorLog($message, $ex = null, $data = ""){
        if($ex != null) $data .= $ex->getMessage() .' '. $ex->getTraceAsString();
        $this->makeLog(LOG_PATH_ERROR, Logger::ERROR, $message, $data);
    }

    /**
     * Use for Information logging like SQL log or activities
     * @param $message String log description
     * @param $data String Extra information
     */
    public function makeInfoLog($message, $data = ""){
        $this->makeLog(LOG_PATH_ACTIVITY, Logger::INFO, $message, $data);
    }


    /**
     * Use for Debugging
     * @param $message String log description
     * @param $data String Extra information
     */
    public function makeDebugLog($message, $data = ""){
        $this->makeLog( LOG_PATH_DEBUG, Logger::DEBUG, $message, $data );
    }

}