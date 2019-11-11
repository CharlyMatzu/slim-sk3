<?php

use Slim\Container;

$container['HttpUtils'] = function(Container $container) {
    return new \Src\Utils\HttpUtils;
};

$container['Files'] = function(Container $container) {
    return new \Src\Utils\File;
};

$container['CsrfExtension'] = function(Container $container) {
    return new \Src\Infraestructure\Extensions\CsrfExtension($container->get('CSRF'));
};

$container['JWT'] = function (Container $container){
    $jwt = $container->get('settings')['jwt'];
    return new \Src\Utils\JwtManager($jwt['key'], $jwt['iss'], $jwt['exp']);
};
