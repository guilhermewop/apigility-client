<?php
namespace GwopApigilityClient\Core;

final class Pagination
{
    /**
     * @const String Índice primário da paginação
     */
    const ROOT = '_links';

    /**
     * @const String Índice que contém o link página
     */
    const HREF = 'href';

    /**
     * @const String Índice da página atual
     */
    const CURRENT = 'self';

    /**
     * @const String Índice da primeira página
     */
    const FIRST = 'first';

    /**
     * @const String Índice da próxima página
     */
    const NEXT = 'next';

    /**
     * @const String Índice da última página
     */
    const LAST = 'last';

    /**
     * @var Array Lista com os links de paginação
     */
    private $links = [];

    /**
     * Constructor
     *
     * @param $links Array
     * @return void
     */
    public function __construct($links = null)
    {
        if (! empty($links)) {
            $this->setLinks($links);
        }
    }

    public function setLinks(array $input)
    {
        $this->links = $input;

        return $this;
    }

    public function getLinks()
    {
        return $this->links;
    }

    public function getCurrentPageLink()
    {
        return $this->links[self::ROOT][self::CURRENT][self::HREF];
    }

    public function getNextPageLink()
    {
        return $this->links[self::ROOT][self::NEXT][self::HREF];
    }

    public function getLastPageLink()
    {
        return $this->links[self::ROOT][self::LAST][self::HREF];
    }

    public function getFirstPageLink()
    {
        return $this->links[self::ROOT][self::FIRST][self::HREF];
    }
}
