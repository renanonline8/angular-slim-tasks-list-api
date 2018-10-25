<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Utils\Controller\Controller;
use App\User as Usr;

class User extends Controller
{
    public function new(Request $request, Response $response)
    {
        $body = $request->getParsedBody();
        $user = new Usr($this->modelUser);
        $user->new($body['email'], $body['senha']);
        
        $result = array('success' => true);
        return $response->withJson($result);
    }

    public function checkUserExist(Request $request, Response $response)
    {
        $user = new Usr($this->modelUser);
        $route = $request->getAttribute('route');
        $filter = $route->getArgument('filter');
        $value = $route->getArgument('value');
        switch ($filter) {
            case 'email':
                $result = array(
                    'filter' => $filter,
                    'value' => $value,
                    'result' => $user->checkExistUserByEmail($value)
                );
                break;
        }

        return $response->withJson($result);
    }
}