<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

//        'db' => [
//            'host' => "localhost",
//            'user' => "root",
//            'pass' => "root",
//            'dbname' => "iot"
//        ],

        // Renderer settings
        'twig' => [
            'template_path' => __DIR__ . '/../template/',
        ],

    ],
];