<?php
namespace ApigilityClientTest;

use ApigilityClientTest\Framework\TestCase;
use ApigilityClient\Module;
use Traversable;

class ModuleTest extends TestCase
{

    public function testGetAutoloaderConfig()
    {
        $module = new Module();
        $config = $module->getAutoloaderConfig();

        if (!is_array($config) && !($config instanceof Traversable)) {
            $this->fail('getAutoloaderConfig expected to return array or Traversable');
        }
    }

    public function testGetConfig()
    {
        $module = new Module();
        $config = $module->getConfig();
        $this->assertInternalType('array', $config);
    }

}
