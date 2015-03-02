<?php
namespace ApigilityClient\Resource;

use ApigilityClient\Exception\UnexpectedValueException;

final class Links
{

    const FIRST_PAGE   = 'first';
    const NEXT_PAGE    = 'next';
    const CURRENT_PAGE = 'self';
    const LAST_PAGE    = 'last';

    /**
     * @var Array
     */
    private $links = array();

    public function __construct(array $links)
    {
        if (! empty($links)) foreach ($links as $key => $val) {
            $this->links[$key] = $val->getHref();
        }
    }

    public function getLink($rel = self::CURRENT_PAGE)
    {
        if (isset($this->links[$rel])) {
            return $this->links[$rel];
        }

        return '';
    }

    public function __get($rel)
    {
        if (! isset($this->links[$rel])) {
            throw new UnexpectedValueException(sprintf(
                'Link "%s" não existe',
                $rel
            ));
        }

        return $this->links[$rel];
    }

}
