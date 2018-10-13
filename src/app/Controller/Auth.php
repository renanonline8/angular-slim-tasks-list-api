<?php
namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Utils\Controller\Controller;

class Auth extends Controller
{
    public function authorize(Request $request, Response $response) {
        return $response->write('Testado!');
    }
}