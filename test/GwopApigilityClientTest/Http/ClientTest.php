<?php
namespace GwopApigilityClientTest\Client;

use GwopApigilityClientTest\Framework\TestCase;

use GwopApigilityClient\Http\Client;

use Zend\Http\Client as ZendHttpClient;

class ClientTest extends TestCase
{
    private $client;

    protected function setUp()
    {
        $this->client = new Client(new ZendHttpClient);
    }

    protected function tearDown()
    {
        $this->client = null;
    }

    public function testGetHttpClient()
    {
        $this->assertInstanceOf('Zend\Http\Client', $this->client->getZendHttpClient());
    }

}
