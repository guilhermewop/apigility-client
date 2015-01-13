<?php
namespace ApigilityClientTest;

use ApigilityClientTest\Framework\TestCase;

class ServiceManagerTest extends TestCase
{

    public function testWillInstanciateServiceManager()
    {
        $this->assertInstanceOf('\Zend\ServiceManager\ServiceManager', $this->getServiceManager());
    }

}
