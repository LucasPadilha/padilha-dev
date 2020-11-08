<?php

return [
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => true,
        'determineRouteBeforeAppMiddleware' => true,

        // defaults
        'defaults' => [
            'timezone' => 'Europe/Rome',
        ],

        // environment
        'environment' => 'development', // production - development

        // database settings
        'database' => [
            'production' => [
                'driver' => 'pgsql',
                'host' => 'padilha-dev_db',
                'username' => 'padilhadev',
                'password' => 'padilhadev',
                'database' => 'padilhadev',
                'charset' => 'utf8',
                'collation' => 'utf8mb4_general_ci',
                'prefix' => ''
            ],
            'development' => [
                'driver' => 'pgsql',
                'host' => 'padilha-dev_db',
                'username' => 'padilhadev',
                'password' => 'padilhadev',
                'database' => 'padilhadev',
                'charset' => 'utf8',
                'collation' => 'utf8mb4_general_ci',
                'prefix' => ''
            ]
        ]
    ]
];