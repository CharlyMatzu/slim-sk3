<?php

$app->options('/{routes:.+}', function (Request $request, Response $response, $args) {
    return $response;
});


include_once 'Routes/BasicRoutes.php';
include_once 'Routes/SecurityRoutes.php';
include_once 'Routes/ViewRoutes.php';
include_once 'Routes/UsersRoutes.php';


// Catch-all route to serve a 404 Not Found page if none of the routes match
// NOTE: make sure this route is defined last
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler;
    return $handler($req, $res);
});