<?php

session_start();

// ----------- GLOBAL CONSTANTS
define('ROOT_PATH', dirname(__DIR__) );
define('SRC_PATH',  ROOT_PATH . '/src');
define('APP_PATH',  ROOT_PATH . '/app');
define('LOG_PATH',  ROOT_PATH . '/logs');

// ----------- COMPOSER
require_once ROOT_PATH . '/vendor/autoload.php';

// new \Slim\Utils\HttpUtils;
// exit;

// ----------- SLIM FRAMEWORK
$settings = require APP_PATH . '/settings.php';
$app = new \Slim\App( $settings );
$container = $app->getContainer();

// Set up Dependencies
require APP_PATH . '/dependencies.php';

// Error Handler
require APP_PATH . '/errorHandler.php';

// Register middleware
require APP_PATH . '/middleware.php';

// Register routes
require APP_PATH . '/router.php';

try {
    $app->run();
} catch (\Slim\Exception\MethodNotAllowedException $e) {
    echo $e->getMessage();
} catch (\Slim\Exception\NotFoundException $e) {
    echo $e->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
}