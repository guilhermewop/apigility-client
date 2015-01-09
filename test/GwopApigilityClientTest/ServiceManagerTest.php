<?php
namespace GwopApigilityClientTest;

use GwopApigilityClientTest\Framework\TestCase;

class ServiceManagerTest extends TestCase
{

    public function testWillInstanciateServiceManager()
    {
        $this->assertInstanceOf('\Zend\ServiceManager\ServiceManager', $this->getServiceManager());
    }

}
