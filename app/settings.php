<?php

// --- ENVIRONMENT
$dotenv = Dotenv\Dotenv::create(ROOT_PATH);
$dotenv->overload();
// required
$dotenv->required(['DISPLAY_ERRORS', 'HOST', 'DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS']);
$dotenv->required(['ENVIRONMENT'])->allowedValues(['PRD', 'DEV']);


// ----- SLIM FRAMEWORK SETTINGS
return [
    'settings' => [
        'displayErrorDetails' => getenv('DISPLAY_ERRORS'),
//        'determineRouteBeforeAppMiddleware' => true,
        
        // Extra data
//        'control' => [
            // 'upload_directory' => ROOT_PATH . '/public/uploads',
//        ],

        // Eloquent settings
        'db' => [
            'driver'    => getenv('DB_DRIVER'),
            'host'      => getenv('DB_HOST'),
            'database'  => getenv('DB_NAME'),
            'username'  => getenv('DB_USER'),
            'password'  => getenv('DB_PASS'),
            'port'      => getenv('DB_PORT'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ],

        

        // Renderer settings
    //    'renderer' => [
    //        'template_path' => __DIR__ . '/../templates/',
    //    ],

       // Monolog settings
    //    'logger' => [
    //        'name' => 'slim-app',
    //        'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
    //        'level' => \Monolog\Logger::DEBUG,
    //    ],
    ],
];