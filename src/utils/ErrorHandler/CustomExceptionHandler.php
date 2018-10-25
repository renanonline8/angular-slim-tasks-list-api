<?php
namespace Utils\ErrorHandler;

class CustomExceptionHandler {
    private $container;
    
    public function __construct($c) {
        $this->container = $c;
    }

    public function __invoke($request, $response, $exception) {
        $this->container->logger->error($exception->getMessage());
        $result = array (
            'error' => true,
            'message' => 'Algo ocorreu de errado, cheque o log'
        );
        return $response
            ->withStatus(500)
            ->withHeader('Content-Type', 'text/html')
            ->withJson($result);
   }
}
