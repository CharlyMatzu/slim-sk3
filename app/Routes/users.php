<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/users', function (App $app) use ($container){

    $app->get('/direct', function(Request $request, Response $response, $params = []) use($container){
        $users = $container->DB->table('users')->get();
        return $response->withJson($users);
    });

    $app->get('', 'UsersController:getUsers');
    $app->get('/{name}', 'UsersController:getUsersByName');
    $app->post('', 'UsersController:addUser');
    $app->put('/{id}', 'UsersController:updateUser');
    $app->delete('/{id}', 'UsersController:deleteUser');

});