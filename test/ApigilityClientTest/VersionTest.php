<?php
namespace ApigilityClientTest;

use ApigilityClientTest\Framework\TestCase;

use ApigilityClient\Version;

class VersionTest extends TestCase
{
    public function testWillRetriveVersionNumber()
    {
        $this->assertEquals('0.1.0-rc1', Version::getVersion());
    }
}
