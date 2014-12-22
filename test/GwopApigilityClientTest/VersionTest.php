<?php
namespace GwopApigilityClientTest;

use GwopApigilityClientTest\Framework\TestCase;

class VersionTest extends TestCase
{
    public function testWillRetriveVersionNumber()
    {
        $this->assertEquals('1.3.0', \GwopApigilityClient\Version::getVersion());
    }
}
