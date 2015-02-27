<?php
namespace ApigilityClientTest\Resource;

use ApigilityClientTest\Framework\TestCase;

use ApigilityClient\Resource\Pagination;

class PaginationTest extends TestCase
{
    private $pagination;

    protected function setUp()
    {
        $data = array(
            'page_count'  => 1,
            'page_size'   => 5,
            'total_items' => 15,
        );

        $this->pagination = new Pagination($data);
    }

    protected function tearDown()
    {
        $this->pagination = null;
    }

    public function testGetPageCount()
    {
        $this->assertEquals(1, $this->pagination->getPageCount());
    }

    public function testGetPageSize()
    {
        $this->assertEquals(5, $this->pagination->getPageSize());
    }

    public function testGetTotalItems()
    {
        $this->assertEquals(15, $this->pagination->getTotalItems());
    }

}
