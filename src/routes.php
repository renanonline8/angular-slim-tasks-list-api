<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->post('/api/auth', 'controllerAuth:authorize');

$app->post('/api/user/new', 'controllerUser:new');

$app->get('/api/user/check_user_exist/{filter}/{value}', 'controllerUser:checkUserExist');

$app->post('/api/user/delete', 'controllerUser:delete')->add(
    new \Utils\Middleware\SuperUserMiddware(
        $container->get('settings')['passSuper']['pass']
    )
);

$app->post('/api/tasks/create', function(Request $request, Response $response, array $args) {
    return $response->withJson(['success'=> true, 'id' => '1', 'message' => 'Tarefa criada com sucesso']);
});

$app->post('/api/tasks/{id}/checked', function(Request $request, Response $response, array $args) {
    return $response->withJson(['success' => true, 'message' => 'Tarefa macada como concluída']);
});

$app->post('/api/tasks/{id}/delete', function(Request $request, Response $response, array $args) {
    return $response->withJson(['success' => false, 'message' => 'Tarefa excluída com sucesso']);
});

$app->get('/api/tasks/lista_fazer', function(Request $request, Response $response, array $args) {
    return $response->withJson([
            ['id' => 1, 'task' => 'Tarefa 1...'],
            ['id' => 2, 'task' => 'Tarefa 2...']
        ]
    );
});

$app->get('/api/tasks/lista_feito', function(Request $request, Response $response, array $args) {
    return $response->withJson([
            ['id' => 3, 'task' => 'Tarefa 3...'],
            ['id' => 4, 'task' => 'Tarefa 3...']
        ]
    );
});