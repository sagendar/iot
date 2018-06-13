<?php

return [
    'settings' => [

        'displayErrorDetails' => true,

        'twig' => [
            'cache' => true,
        ],

        'pdo' => [
            'dsn' => 'mysql:dbname=localhost;host=iot;port=3306;charset=UTF8',
            'user' => 'root',
            'pass' => 'root'
        ],
    ]
];