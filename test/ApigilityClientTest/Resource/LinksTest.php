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
            'self'  => new Level3Link('http://api.local/v1/newspaper/item'),
            'last'  => new Level3Link('http://api.local/v1/newspaper/item?page=1'),
            'first' => new Level3Link('http://api.local/v1/newspaper/item?page=1'),
        );

        $this->links = new Links($data);
    }

    protected function tearDown()
    {
        $this->links = null;
    }

    public function testGetPageLink()
    {
        $this->assertEquals('http://api.local/v1/newspaper/item', $this->links->getPageLink());
        $this->assertEquals('http://api.local/v1/newspaper/item', $this->links->getPageLink(Links::CURRENT_PAGE));
        $this->assertEquals('http://api.local/v1/newspaper/item?page=1', $this->links->getPageLink(Links::LAST_PAGE));
    }

}
