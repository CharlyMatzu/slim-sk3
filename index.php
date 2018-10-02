<?php

require_once "config.php";
//Autoloader for vendor and own classes
require_once "vendor/autoload.php";


//try {
//    $dummy = \App\Persistence\PersistenceSingleton::getInstance();
//    var_dump($dummy->getAll());
//    var_dump( $dummy->searchDummy( "" ) );
//
//    $dum = new \App\Model\Dummy();
//        $dum->setCity("Cd. Obregon");
//        $dum->setCountry("Cd. Obregon");
//        $dum->setNames("Carlos R");
//        $dum->setCompany("Emcor");
//    $dummy->addDummy( $dum );
//
//    echo $dummy->removeDummy( 5 );
//} catch (\App\Exceptions\PersistenceException $e) {  }

session_start();

// Instantiate the app
$settings = require ROOT_PATH . '/app/settings.php';
$app = new \Slim\App( $settings );
//$app = new \Slim\App();

$container = $app->getContainer();

//// Set up dependencies
require ROOT_PATH . '/app/dependencies.php';

//// Register middleware
require ROOT_PATH . '/app/middleware.php';

//// Error Handler
require ROOT_PATH . '/app/errorHandler.php';

//// Register routes
require ROOT_PATH . '/app/routes.php';


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