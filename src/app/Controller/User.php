<?php

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Utils\Controller\Controller;
use App\User\User as Usr;
use App\ResponseAPI\ErrorResponse;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class User extends Controller
{
    public function new(Request $request, Response $response)
    {
        $body = $request->getParsedBody();

        $user = new \StdClass;
        $user->email = $body['email'];
        $user->pass = $body['senha'];

        $userValidator = v::
                attribute('email', v::email())
                ->attribute('pass', v::notEmpty());

        try {
            $userValidator->assert($user);
        } catch (NestedValidationException $e) {
            return (new ErrorResponse($e, $response))->errorReturn();
        }
        
        $user = new Usr($this->modelUser, $this->modelQueryUser);

        try {
            $user->new($body['email'], $body['senha']);
        } catch (\App\User\Exceptions\ExceptionUserAlreadyExist $e) {
            return (new ErrorResponse($e, $response))->errorReturn();
        }
        
        $result = array('success' => true);
        return $response->withJson($result);
    }

    public function checkUserExist(Request $request, Response $response)
    {
        $user = new Usr($this->modelUser, $this->modelQueryUser);
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

                if (!$user->checkExistUserByEmail($value)) {
                    $responseCode = 500;
                } else {
                    $responseCode = 200;
                }

                break;
        }
        return $response->withStatus($responseCode)->withJson($result);
    }

    public function delete(Request $request, Response $response) {
        $email = $request->getParsedBody()['email'];
        $user = new Usr($this->modelUser, $this->modelQueryUser);
        
        try {
            $user->delete($email);
        } catch (\App\User\Exceptions\ExceptionUserNotExist $e) {
            return (new ErrorResponse($e, $response))->errorReturn();
        }
        
        $json = [
            'success' => true,
        ];
        return $response->withJson($json);
    }
}