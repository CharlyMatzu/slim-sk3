<?php

// ------------------
// ENVIRONMENT
// ------------------

$dotEnv = Dotenv\Dotenv::create(ROOT_PATH);
$dotEnv->overload();
// required
$dotEnv->required(['DISPLAY_ERRORS', 'HOST', 'DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS', 'DB_PORT']);
//$dotEnv->required(['ENVIRONMENT'])->allowedValues(['PRD', 'DEV']);



// ------------------
// SLIM FRAMEWORK SETTINGS
// ------------------
return [
    'settings' => [
        'displayErrorDetails' => getenv('DISPLAY_ERRORS'),
        'determineRouteBeforeAppMiddleware' => false,
        // Render
        'view' => [
            'base_path'      => getenv('HOST'),
            'template_path'  => ROOT_PATH . '/public/views',
            'cache'          => (getenv('ENABLE_CACHE') === true)
                ? ROOT_PATH . '/cache'
                : false
        ],
        // Eloquent configuration
        'db' => [
            'driver'    => getenv('DB_DRIVER'),
            'host'      => getenv('DB_HOST'),
            'database'  => getenv('DB_NAME'),
            'username'  => getenv('DB_USER'),
            'password'  => getenv('DB_PASS'),
            'port'      => getenv('DB_PORT'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
        // Monolog settings
         'logger' => [
             'name'  => getenv('APPLICATION_NAME'),
             'path'  => isset($_ENV['docker']) ? 'php://stdout' : LOG_PATH,
             'level' => \Monolog\Logger::DEBUG,
         ],
        'jwt' => [
            'key' => getenv('JWT_KEY'),
            'iss' => getenv('JWT_ISSUER'),
            'expiration' => getenv('JWT_EXPIRATION')
        ],
        // Configuración adicional
        'app' => []
    ],
];