<?php
namespace ApigilityClientTest\Resource;

use Zend\Json\Decoder as JsonDecoder,
    Zend\Json\Json;

use ApigilityClientTest\Framework\TestCase,
    ApigilityClientTest\Utils\FileLoader;

use ApigilityClient\Resource\Pagination,
    ApigilityClient\Resource\Resource,
    ApigilityClient\Resource\Links;

use Level3\Resource\Format\Reader\HAL\JsonReader as HalJsonReader;

class ResourceTest extends TestCase
{
    private $resource;
    private $json;

    protected function setUp()
    {
        $file = FileLoader::loadFile();

        $this->json = (string) trim(file_get_contents($file));

        $halJsonReader = new HalJsonReader;

        $this->resource = new Resource($halJsonReader->execute($this->json));
    }

    protected function tearDown()
    {
        $this->pagination = null;
    }

    public function testGetPagination()
    {
        $this->assertInstanceOf('ApigilityClient\Resource\Pagination', $this->resource->getPagination());
    }

    public function testGetLinks()
    {
        $this->assertInstanceOf('ApigilityClient\Resource\Links', $this->resource->getLinks());
    }

}
