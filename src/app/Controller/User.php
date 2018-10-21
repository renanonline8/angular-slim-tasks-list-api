<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Utils\Controller\Controller;
use App\User\NewUser;

class User extends Controller
{
    public function new(Request $request, Response $response)
    {
        $body = $request->getParsedBody();
        //var_dump($this->modelUser);
        //die();
        $user = new NewUser($this->modelUser);
        $user->new($body['email'], $body['senha']);
        
        $result = array('success' => true);
        return $response->withJson($result);
    }
}