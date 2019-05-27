<?php

$app->group('/users', function (Slim\App $app) {

    $app->get('', 'UsersController:getUsers');
    $app->get('/{name}', 'UsersController:getUsersByName');
    $app->post('', 'UsersController:addUser');
    $app->put('/{id}', 'UsersController:updateUser');
    $app->delete('/{id}', 'UsersController:deleteUser');
});


