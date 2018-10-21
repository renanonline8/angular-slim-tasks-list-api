<?php
// Application middleware

// JSON Web Token
$app->add(new Tuupola\Middleware\JwtAuthentication([
    "path" => $container->get('settings')['jsonWebToken']['path'],
    "ignore" => $container->get('settings')['jsonWebToken']['ignore'],
    "secret" => $container->get('settings')['jsonWebToken']['secretkey'],
    "secure" => true,
    "relexed" => $container->get('settings')['jsonWebToken']['relaxed'],
]));