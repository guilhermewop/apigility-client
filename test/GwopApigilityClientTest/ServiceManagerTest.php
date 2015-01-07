<?php
namespace GwopApigilityClientTest;

use GwopApigilityClientTest\Framework\TestCase;

class ServiceManagerTest extends TestCase
{

    public function testWillInstanciateServiceManager()
    {
        $this->assertInstanceOf('\Zend\ServiceManager\ServiceManager', $this->getServiceManager());
    }

    public function testWillInstanciateEndpointService()
    {
        $instanceFromFactory = $this->getServiceManager()->get('gwop.apigility.endpoint');
        $instanceFromAlias = $this->getServiceManager()->get('GwopApigilityClient\Service\Endpoint');

        $this->assertInstanceOf('\GwopApigilityClient\Service\Endpoint', $instanceFromFactory);
        $this->assertInstanceOf('\GwopApigilityClient\Service\Endpoint', $instanceFromAlias);
        $this->assertEquals($instanceFromFactory, $instanceFromAlias);
    }

}
