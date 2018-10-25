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

        $resCheckUser = $this->runApp('GET', '/api/user/check_user_exist/email/' . $bodyTest['email']);
        $result = json_decode((string)$resCheckUser->getBody());
        
        if (!$result->result) {
            $response = $this->runApp('POST', '/api/user/new', $bodyTest);
            $this->assertEquals(200, $response->getStatusCode());
        } else {
            $this->markTestSkipped('Usuario já existe');
        }
    }
}