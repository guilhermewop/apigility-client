<?php
namespace ApigilityClientTest\Resource;

use ApigilityClientTest\Framework\TestCase;

use ApigilityClient\Resource\Links;

use Level3\Resource\Link as Level3Link;

class LinksTest extends TestCase
{
    private $links;

    protected function setUp()
    {
        $data = array(
            'self'  => new Level3Link('http://api.localhost/v1/endpoint'),
            'first' => new Level3Link('http://api.localhost/v1/endpoint'),
            'next'  => new Level3Link('http://api.localhost/v1/endpoint?page=2'),
            'last'  => new Level3Link('http://api.localhost/v1/endpoint?page=3'),
        );

        $this->links = new Links($data);
    }

    protected function tearDown()
    {
        $this->links = null;
    }

    public function testGetPageLink()
    {
        $this->assertEquals('http://api.localhost/v1/endpoint', $this->links->getLink(Links::CURRENT_PAGE));
        $this->assertEquals('http://api.localhost/v1/endpoint', $this->links->getLink(Links::FIRST_PAGE));
        $this->assertEquals('http://api.localhost/v1/endpoint?page=2', $this->links->getLink(Links::NEXT_PAGE));
        $this->assertEquals('http://api.localhost/v1/endpoint?page=3', $this->links->getLink(Links::LAST_PAGE));
    }

}
