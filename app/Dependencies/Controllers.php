<?php

// ---------------------------
// CONTROLLERS
// ---------------------------


use Slim\Container;

$container['BasicController'] = function(Container $container){
    return new Src\Controllers\BasicController;
};


$container['UsersController'] = function(Container $container){
    return new Src\Controllers\UsersController;
};