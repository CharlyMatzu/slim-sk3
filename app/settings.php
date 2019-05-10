<?php


// ----- SLIM FRAMEWORK SETTINGS
return [
    'settings' => [
//        'displayErrorDetails' => true, //FALSE for Production
//        'determineRouteBeforeAppMiddleware' => true,
        
        // Extra data
        'control' => [
            // 'upload_directory' => ROOT_PATH . '/public/uploads',
        ],

        // Eloquent settings
        'db' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'Skeleton',
            'username'  => 'skeleton_user',
            'password'  => 'skeleton_pass',
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