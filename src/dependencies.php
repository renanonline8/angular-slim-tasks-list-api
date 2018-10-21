<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

//Controller Auth
$container['controllerAuth'] = function($c) {
    return new \App\Controller\Auth($c);
};

$container['controllerUser'] = function($c) {
    return new \App\Controller\User($c);
};

//Models
$container['modelUser'] = function($c) {
    return new \App\Model\User();
};

$container['modelToken'] = function($c) {
    return new \App\Model\Token();
};