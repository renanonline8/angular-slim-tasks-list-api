<?php

namespace Tests\Functional;

class UserTest extends BaseTestCase
{
    public function testCreateUser()
    {
        $bodyTest = array(
            'email' => 'renanonline8@gmail.com',
            'senha' => 'ad23ol12'
        );

        $response = $this->runApp('POST', '/api/user/new', $bodyTest);
        
        $this->assertEquals(200, $response->getStatusCode());
    }
}