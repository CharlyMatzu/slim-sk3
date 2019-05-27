<?php

$app->get('/users', 'UsersController:getUsers');

//$app->group('/users', function (Slim\App $app) {

//    $app->get('', 'RequestController:getUsers');

//    $app->get('{id}', 'RequestController:getUser');

//});


