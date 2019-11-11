<?php

use Slim\Container;

$container['UsersService'] = function(Container $container){
    return new \Src\Services\UsersService;
};
