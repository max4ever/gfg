<?php

namespace Tests\Functional;

use Gfg\Error\Handler\CustomErrorHandler;

class ProductsTest extends BaseTestCase
{
    /**
     * Test that the api responds ok
     */
    public function testAllProductsList()
    {
        $response = $this->runApp('GET', '/products');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(count(json_decode($response->getBody())), 100);//default 100 products in db
    }

    /**
     * Test that the api responds ok
     */
    public function testFilterByTitle()
    {
        $response = $this->runApp('GET', '/products?q=.net');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(count(json_decode($response->getBody())), 7);
    }

    /**
     * Test that the api responds ok
     */
    public function testFilterByTitle2()
    {
        $response = $this->runApp('GET', '/products?q=tremblay');

        $this->assertEquals(200, $response->getStatusCode());
        $sJson = '[{"id":"12","title":"tremblay.com","brand":"dolorem","price":"94953540.00","stock":"4"}]';
        $this->assertEquals(json_decode($sJson), json_decode($response->getBody()));
    }

    /**
     * Test that the api responds blank
     */
    public function testGetNoResult()
    {
        $response = $this->runApp('GET', '/products?q=----');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals([], json_decode($response->getBody(), true));
    }

    /**
     * Test that the index route won't accept a post request
     */
    public function testPostHomepageNotAllowed()
    {
        $response = $this->runApp('POST', '/products', ['test']);

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertContains('Method not allowed', (string)$response->getBody());
    }

    /**
     * Test the error handler works
     */
    public function testErrorEmptyQuery()
    {
        $response = $this->runApp('GET', '/products?q=');

        $this->assertEquals(CustomErrorHandler::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
        $this->assertEquals(['error_msg' => 'query cannot be empty', 'error_type' => 'InvalidArgumentException'], json_decode($response->getBody(), true));
    }

}