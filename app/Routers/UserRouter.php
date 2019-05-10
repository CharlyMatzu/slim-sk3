<?php

$app->group('/user', function (Slim\App $app) {

    $app->get('[/]', 'RequestController:getUsers');

    $app->get('/{id}', 'RequestController:getUser');

});


