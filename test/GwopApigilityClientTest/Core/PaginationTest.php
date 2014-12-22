<?php
namespace GwopApigilityClientTest\Core;

use GwopApigilityClientTest\Framework\TestCase;

use GwopApigilityClient\Core\Pagination;

class PaginationTest extends TestCase
{
    private $content;

    protected function setUp()
    {
        $this->content = [
            '_links' => [
                'self' => [
                    'href' => 'http://direct-api.local/v1/common/geolocation/state/16/city?page=1',
                ],
                'first' => [
                    'href' => 'http://direct-api.local/v1/common/geolocation/state/16/city',
                ],
                'last' => [
                    'href' => 'http://direct-api.local/v1/common/geolocation/state/16/city?page=6',
                ],
                'next' => [
                    'href' => 'http://direct-api.local/v1/common/geolocation/state/16/city?page=2',
                ],
            ],
        ];
    }

    protected function tearDown()
    {
        $this->content = null;
    }

    public function testPaginationDataStructure()
    {
        // raiz
        $this->assertArrayHasKey(Pagination::ROOT, $this->content);

        // páginas
        $this->assertArrayHasKey(Pagination::CURRENT, $this->content[Pagination::ROOT]);
        $this->assertArrayHasKey(Pagination::FIRST, $this->content[Pagination::ROOT]);
        $this->assertArrayHasKey(Pagination::LAST, $this->content[Pagination::ROOT]);
        $this->assertArrayHasKey(Pagination::NEXT, $this->content[Pagination::ROOT]);

        // links
        $this->assertArrayHasKey(Pagination::HREF, $this->content[Pagination::ROOT][Pagination::CURRENT]);
        $this->assertArrayHasKey(Pagination::HREF, $this->content[Pagination::ROOT][Pagination::FIRST]);
        $this->assertArrayHasKey(Pagination::HREF, $this->content[Pagination::ROOT][Pagination::LAST]);
        $this->assertArrayHasKey(Pagination::HREF, $this->content[Pagination::ROOT][Pagination::NEXT]);
    }

}
