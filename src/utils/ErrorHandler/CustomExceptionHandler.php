<?php
namespace Utils\ErrorHandler;

class CustomExceptionHandler {
    private $container;
    
    public function __construct($c) {
        $this->container = $c;
    }

    public function __invoke($request, $response, $exception) {
        $errorMessage = 'Route: ' . $request->getUri();
        $errorMessage .= ' - Message: ' . $exception->getMessage();
        $this->container->logger->error($errorMessage);
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
