<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        //JSON Web Token settings
        'jsonWebToken' => [
            'secretkey' => getenv('SECRET_KEY'),
            'path' => '/api',
            'ignore' => ['/api/auth', '/api/user'],
            'relaxed' => ['localhost/angular-slim-tasks-list/public'],
        ],

        //PassUsper
        'passSuper' => [
            'pass' => getenv('PASS_SUPER'),
        ]
    ],
];
