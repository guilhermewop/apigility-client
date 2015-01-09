<?php
namespace GwopApigilityClientTest\Resource;

use GwopApigilityClientTest\Framework\TestCase;

use Zend\Json\Decoder as JsonDecoder,
    Zend\Json\Json;

use GwopApigilityClientTest\Utils\FileLoader;

use GwopApigilityClient\Resource\Pagination,
    GwopApigilityClient\Resource\Resource,
    GwopApigilityClient\Resource\Links;

use Level3\Resource\Resource as Level3Resource;
use Level3\Resource\Format\Reader\HAL\JsonReader as HalJson;

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
        $this->assertInstanceOf('GwopApigilityClient\Resource\Pagination', $this->resource->getPagination());
    }

    public function testGetLinks()
    {
        $links = $this->resource->getLinks();

        $this->assertInstanceOf('GwopApigilityClient\Resource\Links', $links);
    }

}
