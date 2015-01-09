<?php
namespace GwopApigilityClientTest\Resource;

use GwopApigilityClientTest\Framework\TestCase;

use Zend\Json\Decoder as JsonDecoder,
    Zend\Json\Json;

use GwopApigilityClientTest\Utils\FileLoader;

use GwopApigilityClient\Resource\Pagination,
    GwopApigilityClient\Resource\Resource;

class ResourceTest extends TestCase
{
    private $resource;
    private $data;

    protected function setUp()
    {
        $file = FileLoader::loadFile();

        $this->data = JsonDecoder::decode(file_get_contents($file), Json::TYPE_ARRAY);

        $this->resource = new Resource($this->data);
    }

    protected function tearDown()
    {
        $this->pagination = null;
    }

    public function testGetData()
    {
        $this->assertEquals($this->data, $this->resource->getData());
    }

    public function testGetPagination()
    {
        $this->assertInstanceOf('GwopApigilityClient\Resource\Pagination', $this->resource->getPagination());
    }


}
