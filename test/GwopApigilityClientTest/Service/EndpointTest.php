<?php
namespace GwopApigilityClientTest\Service;

use GwopApigilityClientTest\Framework\TestCase;

use GwopApigilityClient\Service\Endpoint;

class EndpointTest extends TestCase
{

    public function testSetVersionSuccessfully()
    {
        $endpoint = $this->getServiceManager()->get('gwop.apigility.endpoint');

        $endpoint->setVersion(2);

        $this->assertEquals(2, $endpoint->getVersion());
    }
}
