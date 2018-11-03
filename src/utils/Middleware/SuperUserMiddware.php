<?php

namespace Utils\Middleware;

class SuperUserMiddware
{
    private $hash;

    public function __construct($passSuper)
    {
        $this->hash = $passSuper;
    }

    public function __invoke($request, $response, $next)
    {
        if (!password_verify($request->getHeaderLine('Superpass'), $this->hash)) {
            return $response->withStatus(401);
        }

        $response = $next($request, $response);

        return $response;
    }
}