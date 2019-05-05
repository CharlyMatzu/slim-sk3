<?php
/**
 * Created by PhpStorm.
 * User: Carlos R. Zuñiga
 * Date: 27/08/2018
 * Time: 09:27 AM
 */

return [
    'settings' => [
        'displayErrorDetails' => true, //FALSE for Production
        "determineRouteBeforeAppMiddleware" => true,
    ]
];

//return [
//    'settings' => [
//        'displayErrorDetails' => true, // set to false in production
//        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
//
//        // Renderer settings
////        'renderer' => [
////            'template_path' => __DIR__ . '/../templates/',
////        ],
//
//        // Monolog settings
//        'logger' => [
//            'name' => 'slim-app',
//            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
//            'level' => \Monolog\Logger::DEBUG,
//        ],
//    ],
//];
