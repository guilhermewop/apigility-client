<?php
namespace GwopApigilityClientTest\Core;

use GwopApigilityClientTest\Framework\TestCase;

use GwopApigilityClient\Core\Pagination;

class PaginationTest extends TestCase
{
    /**
     * @var \GwopApigilityClient\Core\Pagination
     */
    private $pagination;

    protected function setUp()
    {
        $links = [
            '_links' => [
                'self' => [
                    'href' => 'http://api.local/v1/common/geolocation/state/16/city?page=1',
                ],
                'first' => [
                    'href' => 'http://api.local/v1/common/geolocation/state/16/city',
                ],
                'last' => [
                    'href' => 'http://api.local/v1/common/geolocation/state/16/city?page=6',
                ],
                'next' => [
                    'href' => 'http://api.local/v1/common/geolocation/state/16/city?page=2',
                ],
            ],
        ];

        $this->pagination = new Pagination($links);
    }

    protected function tearDown()
    {
        $this->pagination = null;
    }

    public function testPaginationDataStructure()
    {
        $links = $this->pagination->getLinks();

        // raiz
        $this->assertArrayHasKey(Pagination::ROOT, $links);

        // páginas
        $this->assertArrayHasKey(Pagination::CURRENT, $links[Pagination::ROOT]);
        $this->assertArrayHasKey(Pagination::FIRST, $links[Pagination::ROOT]);
        $this->assertArrayHasKey(Pagination::LAST, $links[Pagination::ROOT]);
        $this->assertArrayHasKey(Pagination::NEXT, $links[Pagination::ROOT]);

        // links
        $this->assertArrayHasKey(Pagination::HREF, $links[Pagination::ROOT][Pagination::CURRENT]);
        $this->assertArrayHasKey(Pagination::HREF, $links[Pagination::ROOT][Pagination::FIRST]);
        $this->assertArrayHasKey(Pagination::HREF, $links[Pagination::ROOT][Pagination::LAST]);
        $this->assertArrayHasKey(Pagination::HREF, $links[Pagination::ROOT][Pagination::NEXT]);
    }

    public function testGetCurrentPageLink()
    {
        $this->assertEquals(
            'http://api.local/v1/common/geolocation/state/16/city?page=1',
            $this->pagination->getCurrentPageLink()
        );
    }

    public function testGetFirstPageLink()
    {
        $this->assertEquals(
            'http://api.local/v1/common/geolocation/state/16/city',
            $this->pagination->getFirstPageLink()
        );
    }

    public function testGetNextPageLink()
    {
        $this->assertEquals(
            'http://api.local/v1/common/geolocation/state/16/city?page=2',
            $this->pagination->getNextPageLink()
        );
    }

    public function testGetLastPageLink()
    {
        $this->assertEquals(
            'http://api.local/v1/common/geolocation/state/16/city?page=6',
            $this->pagination->getLastPageLink()
        );
    }


}
