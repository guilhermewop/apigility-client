<?php
namespace GwopApigilityClientTest\Core\Pagination;

use GwopApigilityClientTest\Framework\TestCase;

use GwopApigilityClient\Core\Pagination\Links as CoreLinks,
    GwopApigilityClient\Exception;

class LinksTest extends TestCase
{

    /**
     * @var \GwopApigilityClient\Core\Pagination\Links
     */
     private $links;

    protected function tearDown()
    {
        $this->links = null;
    }

    /**
     * @dataProvider pageLinksProvider
     */
    public function testConstructorSuccess($pages)
    {
        $links = new CoreLinks($pages);
    }

    /**
     * @dataProvider pageLinksProvider
     * @expectedException GwopApigilityClient\Exception\InvalidArgumentException
     * @expectedExceptionMessage Links de paginação não podem ser um array vazio
     */
    public function testOverrideSetLinksThrowsInvalidArgumentException($pages)
    {
        $links = new CoreLinks($pages);
        $links->setLinks([]);
    }

    /**
     * @dataProvider pageLinksProvider
     */
    public function testGetLinks($pages)
    {
        $links = new CoreLinks($pages);

        $this->assertEquals($pages, $links->getLinks());
    }

    /**
     * @dataProvider pageLinksProvider
     */
    public function testGetCurrentPageLink($pages)
    {
        $links = new CoreLinks($pages);

        $this->assertNotEmpty($links->getCurrentPageLink());
    }

    /**
     * @dataProvider pageLinksProvider
     * @expectedException GwopApigilityClient\Exception\RuntimeException
     * @expectedExceptionMessage Não foi possível encontrar o link da página atual
     */
    public function testGetCurrentPageLinkThrowsRuntimeException($pages)
    {
        unset($pages[CoreLinks::ROOT][CoreLinks::CURRENT][CoreLinks::HREF]);

        $links = new CoreLinks($pages);

        $this->assertNotEmpty($links->getCurrentPageLink());
    }

    /**
     * @dataProvider pageLinksProvider
     */
    public function testGetNextPageLink($pages)
    {
        $links = new CoreLinks($pages);

        $this->assertNotEmpty($links->getNextPageLink());
    }

    /**
     * @dataProvider pageLinksProvider
     */
    public function testGetNextPageLinkIsNull($pages)
    {
        unset($pages[CoreLinks::ROOT][CoreLinks::NEXT][CoreLinks::HREF]);

        $links = new CoreLinks($pages);

        $this->assertNull($links->getNextPageLink());
    }

    /**
     * @dataProvider pageLinksProvider
     */
    public function testGetFirstPageLink($pages)
    {
        $links = new CoreLinks($pages);

        $this->assertNotEmpty($links->getFirstPageLink());
    }

    /**
     * @dataProvider pageLinksProvider
     * @expectedException GwopApigilityClient\Exception\RuntimeException
     * @expectedExceptionMessage Não foi possível encontrar o link da primeira página
     */
    public function testGetFirstPageLinkThrowsRuntimeException($pages)
    {
        unset($pages[CoreLinks::ROOT][CoreLinks::FIRST][CoreLinks::HREF]);

        $links = new CoreLinks($pages);

        $this->assertNotEmpty($links->getFirstPageLink());
    }

    /**
     * @dataProvider pageLinksProvider
     */
    public function testGetLastPageLink($pages)
    {
        $links = new CoreLinks($pages);

        $this->assertNotEmpty($links->getLastPageLink());
    }

    /**
     * @dataProvider pageLinksProvider
     * @expectedException GwopApigilityClient\Exception\RuntimeException
     * @expectedExceptionMessage Não foi possível encontrar o link da última página
     */
    public function testGetLastPageLinkThrowsRuntimeException($pages)
    {
        unset($pages[CoreLinks::ROOT][CoreLinks::LAST][CoreLinks::HREF]);

        $links = new CoreLinks($pages);

        $this->assertNotEmpty($links->getLastPageLink());
    }

    public function pageLinksProvider()
    {
        return [[[
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
        ]]];
    }

}
