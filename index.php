<?php

require_once "config.php";
//Autoloader for libs and own classes
require_once "vendor/autoload.php";

session_start();

// Instantiate the app
$settings = require ROOT_PATH . '/app/includes/settings.php';
$app = new \Slim\App( $settings );
//$app = new \Slim\App();

$container = $app->getContainer();

// Set up dependencies
require ROOT_PATH . '/app/includes/dependencies.php';

// Register middleware
require ROOT_PATH . '/app/includes/middleware.php';

// Register Twig render
require_once ROOT_PATH . '/app/includes/render.php';

// Error Handler
require ROOT_PATH . '/app/includes/errorHandler.php';

// Register routes
require ROOT_PATH . '/app/includes/routes.php';


try {
    // Run app
    $app->run();
} catch (\Slim\Exception\MethodNotAllowedException $e) {
    echo "Error: ".$e->getMessage();
} catch (\Slim\Exception\NotFoundException $e) {
    echo "Error: ".$e->getMessage();
} catch (Exception $e) {
    echo "Error: ".$e->getMessage();
}