<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

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