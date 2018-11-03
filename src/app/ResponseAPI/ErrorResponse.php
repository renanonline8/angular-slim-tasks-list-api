<?php
namespace App\ResponseAPI;

use Slim\Http\Response;

class ErrorResponse
{
    private $exp;
    private $response;

    public function __construct(\Exception $exp, Response $response)
    {
        $this->exp = $exp;
        $this->response = $response;
    }

    public function errorReturn()
    {
        $json = [
            'sucess' => false,
            'error_message' => $this->exp->getMessage(),
        ];
        return $this->response->withStatus(500)->withJson($json);
    }
}