<?php
namespace GwopApigilityClientTest\Service;

use GwopApigilityClientTest\Framework\TestCase;

use GwopApigilityClient\Service\Endpoint;

class EndpointTest extends TestCase
{

    public function testVersion()
    {
        $endpoint = $this->getServiceManager()->get('gwop.apigility.endpoint');

        $endpoint->setVersion(2);
        $this->assertEquals(2, $endpoint->getVersion());

        $endpoint->setVersion(0);
        $this->assertEquals(2, $endpoint->getVersion());

        $endpoint->setVersion('foo');
        $this->assertEquals(2, $endpoint->getVersion());

        $endpoint->setVersion(1);
        $this->assertEquals(1, $endpoint->getVersion());

        $endpoint->setVersion(-1);
        $this->assertEquals(1, $endpoint->getVersion());
    }

    public function testPath()
    {
        $endpoint = $this->getServiceManager()->get('gwop.apigility.endpoint');

        // with slash
        $endpoint->setPath('/endpoint');
        $this->assertEquals('/endpoint', $endpoint->getPath());

        // no slash
        $endpoint->setPath('endpoint');
        $this->assertEquals('/endpoint', $endpoint->getPath());
    }
}
