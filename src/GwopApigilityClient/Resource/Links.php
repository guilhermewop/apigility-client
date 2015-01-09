<?php
namespace GwopApigilityClient\Resource;

use Level3\Resource\Link as Level3Links;

final class Links
{

    const FIRST_PAGE   = 'first';
    const NEXT_PAGE    = 'next';
    const CURRENT_PAGE = 'self';
    const LAST_PAGE    = 'last';

    private $links = array();

    public function __construct(array $links)
    {
        $this->links = $links;
    }

    public function getLinkPage($rel = self::CURRENT_PAGE)
    {
        return $this->links[$rel]['href'];
    }

}
