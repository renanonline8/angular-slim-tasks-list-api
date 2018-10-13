<?php
// Application middleware

// JSON Web Token
$app->add(new Tuupola\Middleware\JwtAuthentication([
    "path" => "/api",
    "ignore" => '/api/auth',
    "secret" => $container->get('settings')['jsonWebToken']['secretkey'],
    "secure" => true,
    "relexed" => ['localhost/angular-slim-tasks-list/public'],
]));