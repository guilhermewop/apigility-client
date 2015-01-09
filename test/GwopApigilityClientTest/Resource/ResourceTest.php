<?php
namespace GwopApigilityClientTest\Resource;

use GwopApigilityClientTest\Framework\TestCase;

use Zend\Json\Decoder as JsonDecoder,
    Zend\Json\Json;

use GwopApigilityClientTest\Utils\FileLoader;

use GwopApigilityClient\Resource\Pagination,
    GwopApigilityClient\Resource\Resource;

use Level3\Resource\Resource as Level3Resource;
use Level3\Resource\Format\Reader\HAL\JsonReader as HalJson;

class ResourceTest extends TestCase
{
    private $resource;
    private $data;

    protected function setUp()
    {
        $file = FileLoader::loadFile();

        $this->data = (string) trim(file_get_contents($file));

        $halJson = new HalJson;

        $this->resource = new Resource($halJson->execute($this->data));
    }

    protected function tearDown()
    {
        $this->pagination = null;
    }

    public function testGetData()
    {
        $this->assertInstanceOf('Level3\Resource\Resource', $this->resource->getData());
    }

    public function testGetPagination()
    {
        $this->assertInstanceOf('GwopApigilityClient\Resource\Pagination', $this->resource->getPagination());
    }

}
