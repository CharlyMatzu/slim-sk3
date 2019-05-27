<?php

$container['RequestMiddleware'] = function($container){
    return new App\Middlewares\RequestMiddleware($container);
};

// Add Global Middleware
$app->add(new \App\Middlewares\CorsMiddleware($container));
