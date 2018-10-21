<?php

namespace Tests\Functional;

class HomepageTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
    public function testGetHomepageWithoutName()
    {
        $this->markTestSkipped('Inutil');
        
        /*$response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('SlimFramework', (string)$response->getBody());
        $this->assertNotContains('Hello', (string)$response->getBody());*/
    }

    /**
     * Test that the index route with optional name argument returns a rendered greeting
     */
    public function testGetHomepageWithGreeting()
    {
        $this->markTestSkipped('Inutil');

        /*$response = $this->runApp('GET', '/name');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Hello name!', (string)$response->getBody());*/
    }

    /**
     * Test that the index route won't accept a post request
     */
    public function testPostHomepageNotAllowed()
    {
        $this->markTestSkipped('Inutil');

        /*$response = $this->runApp('POST', '/', ['test']);

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertContains('Method not allowed', (string)$response->getBody());*/
    }
}