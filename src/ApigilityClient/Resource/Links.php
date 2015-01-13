<?php
namespace ApigilityClient\Resource;

use Level3\Resource\Link as Level3Links;

final class Links
{

    const FIRST_PAGE   = 'first';
    const NEXT_PAGE    = 'next';
    const CURRENT_PAGE = 'self';
    const LAST_PAGE    = 'last';

    /**
     * @var Array of Level3\Resource\Link
     */
    private $links = array();

    public function __construct(array $links)
    {
        $this->links = $links;
    }

    public function getPageLink($rel = self::CURRENT_PAGE)
    {
        if (isset($this->links[$rel])) {
            return $this->links[$rel]->getHref();
        }

        return '';
    }

}
