<?php
/**
 * Created by PhpStorm.
 * User: Carlos R. Zuñiga
 * Date: 20/08/2018
 * Time: 04:02 PM
 */

error_reporting( E_ERROR | E_PARSE );

//define('PROTOCOL',      'https://');
//define('SERVER_URI',    PROTOCOL . $SERVER . ROOT_HOST);

define("DS", DIRECTORY_SEPARATOR);
define('ROOT_PATH', __DIR__ );
define("VENDOR_PATH",  ROOT_PATH . DS . "libs");
define("APP_PATH",  ROOT_PATH . DS . "app");
define("INCLUDES_PATH", APP_PATH . DS . "includes");

// Keep in mind the log location. Apache (server) will be the owner and only root or directory owner (of logs) will be able
// to manage those file
define("LOG_PATH",  ROOT_PATH . DS . "logs");
define("LOG_ACTIVITY",  LOG_PATH . DS . "activity");
define("LOG_DEBUG",  LOG_PATH . DS . "debug");
define("LOG_ERROR",  LOG_PATH . DS . "error");
