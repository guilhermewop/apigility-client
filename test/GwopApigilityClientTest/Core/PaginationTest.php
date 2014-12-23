<?php
namespace GwopApigilityClientTest\Core;

use GwopApigilityClientTest\Framework\TestCase;

use GwopApigilityClient\Core\Pagination as CorePagination,
    GwopApigilityClient\Core\Pagination\Links as CoreLinks;

class PaginationTest extends TestCase
{
    /**
     * @var \GwopApigilityClient\Core\Pagination
     */
    private $pagination;

    protected function tearDown()
    {
        $this->pagination = null;
    }

    /**
     * @dataProvider pageInfoProvider
     */
    public function testConstructor($pageInfo)
    {
        $linksTest = new Pagination\LinksTest;
        $pages = $linksTest->pageLinksProvider();
        $pages = array_shift($pages);
        $pages = array_shift($pages);

        // sem info de paginação
        $pagination = new CorePagination($pages);
        $this->assertInstanceOf('GwopApigilityClient\Core\Pagination\Links', $pagination->getLinks());

        // com info de paginação
        $pagination = new CorePagination(new CoreLinks($pages), $pageInfo);
        $this->assertInstanceOf('GwopApigilityClient\Core\Pagination\Links', $pagination->getLinks());
        $this->assertNotEmpty($pagination->getPageSize());
        $this->assertNotEmpty($pagination->getPageCount());
        $this->assertNotEmpty($pagination->getTotalItems());
    }

    public function pageInfoProvider()
    {
        return [[[
            'page_count'  => 6,
            'page_size'   => 200,
            'total_items' => 1170,
        ]]];
    }

}
