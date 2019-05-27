<?php

// ----------- GLOBAL CONSTANTS
// error_reporting( E_ERROR | E_PARSE );
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', __DIR__ );
define('APP_PATH',  ROOT_PATH . DS . 'app');

// Keep in mind the log location. Apache (server) will be the owner and only root or directory owner (of logs) will be able to manage those file
define('LOG_PATH',  ROOT_PATH . DS . 'logs');
define('LOG_ACTIVITY',  LOG_PATH . DS . 'activity');
define('LOG_DEBUG',  LOG_PATH . DS . 'debug');
define('LOG_ERROR',  LOG_PATH . DS . 'error');

// ----------- COMPOSER
require_once "vendor/autoload.php";
session_start();

// ----------- SLIM FRAMEWORK
$settings = require APP_PATH . '/settings.php';
$app = new \Slim\App( $settings );

$container = $app->getContainer();

// Set up dependencies
require APP_PATH . '/dependencies.php';

// Register middleware
require APP_PATH . '/middleware.php';

// Error Handler
require APP_PATH . '/errorHandler.php';

// Register routes
require APP_PATH . '/routes.php';


// Run app
$app->run();

//try {
//    // Run app
//    $app->run();
//} catch (\Slim\Exception\MethodNotAllowedException $e) {
//    echo "Error: ".$e->getMessage();
//} catch (\Slim\Exception\NotFoundException $e) {
//    echo "Error: ".$e->getMessage();
//} catch (Exception $e) {
//    echo "Error: ".$e->getMessage();
//}