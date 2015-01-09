<?php
namespace ApigilityClientTest\Resource;

use Zend\Json\Decoder as JsonDecoder,
    Zend\Json\Json;

use ApigilityClientTest\Framework\TestCase,
    ApigilityClientTest\Utils\FileLoader;

use ApigilityClient\Resource\Pagination,
    ApigilityClient\Resource\Resource,
    ApigilityClient\Resource\Links;

use Level3\Resource\Resource as Level3Resource,
    Level3\Resource\Format\Reader\HAL\JsonReader as HalJson;

class ResourceTest extends TestCase
{
    private $resource;
    private $json;

    protected function setUp()
    {
        $file = FileLoader::loadFile();

        $this->json = (string) trim(file_get_contents($file));

        $halJson = new HalJson;

        $this->resource = new Resource($halJson->execute($this->json));
    }

    protected function tearDown()
    {
        $this->pagination = null;
    }

    public function testGetResource()
    {
        $this->assertInstanceOf('Level3\Resource\Resource', $this->resource->getResource());
    }

    public function testGetPagination()
    {
        $this->assertInstanceOf('ApigilityClient\Resource\Pagination', $this->resource->getPagination());
    }

    public function testGetLinks()
    {
        $links = $this->resource->getLinks();

        $this->assertInstanceOf('ApigilityClient\Resource\Links', $links);
    }

    public function testGetContent()
    {
        $content = $this->resource->getContent('content');

        $this->assertInternalType('array', $content);

        foreach ($content as $key => $value) {
            $this->assertInstanceOf('Level3\Resource\Resource', $value);
        }
    }

}
