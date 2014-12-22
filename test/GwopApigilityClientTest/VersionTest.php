<?php
namespace GwopApigilityClientTest;

use GwopApigilityClientTest\Framework\TestCase;

class VersionTest extends TestCase
{
    public function testWillRetriveVersionNumber()
    {
        $this->assertEquals('0.1.0', \GwopApigilityClient\Version::getVersion());
    }
}
