<?php
namespace ApigilityClientTest\Http;

use ApigilityClientTest\Framework\TestCase;

use ApigilityClient\Http\Client as HttpClient,
    ApigilityClient\Http\Response;

use Zend\Http\Client as ZendHttpClient;

class ClientTest extends TestCase
{
    private $client;

    protected function setUp()
    {
        $zendHttpClient = new ZendHttpClient;
        $zendHttpClient->getUri()->setHost('api-server.local');

        $this->client = new HttpClient($zendHttpClient);
    }

    protected function tearDown()
    {
        $this->client = null;
    }

    public function testGetZendHttpClient()
    {
        $this->assertInstanceOf('Zend\Http\Client', $this->client->getZendHttpClient());
    }

    /**
     * @expectedException ApigilityClient\Exception\RuntimeException
     * @expectedExceptionMessage Function not implemented
     */
    public function testPostMethodNotImplementedThrowsAnException()
    {
        $this->client->post('/', array('foo' => 'bar'));
    }

    /**
    * @expectedException ApigilityClient\Exception\RuntimeException
    * @expectedExceptionMessage Function not implemented
    */
    public function testDeleteMethodNotImplementedThrowsAnException()
    {
        $this->client->delete('/');
    }

}
