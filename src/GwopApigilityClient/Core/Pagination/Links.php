<?php
namespace GwopApigilityClient\Core\Pagination;

use GwopApigilityClient\Exception;

final class Links
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
    private $links = array();

    /**
     * Constructor
     *
     * @param $links Array
     * @return void
     */
    public function __construct($links)
    {
        $this->setLinks($links);
    }

    /**
     * Define a lista de links da paginação
     *
     * @param Array $input Lista de links
     * @return self
     */
    public function setLinks(array $input)
    {
        if (empty($input)) {
            throw new Exception\InvalidArgumentException('Links de paginação não podem ser um array vazio');
        }

        if (! isset($input[self::ROOT][self::CURRENT][self::HREF])) {
            throw new Exception\RuntimeException(
                'Não foi possível encontrar o link da página atual'
            );
        }

        if (! isset($input[self::ROOT][self::FIRST][self::HREF])) {
            throw new Exception\RuntimeException(
                'Não foi possível encontrar o link da primeira página'
            );
        }

        if (! isset($input[self::ROOT][self::LAST][self::HREF])) {
            throw new Exception\RuntimeException(
                'Não foi possível encontrar o link da última página'
            );
        }

        $this->links = $input;

        return $this;
    }

    /**
     * Obtém a lista de links
     *
     * @return Array
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Obtém o link da página atual
     *
     * @return String
     */
    public function getCurrentPageLink()
    {
        return $this->links[self::ROOT][self::CURRENT][self::HREF];
    }

    /**
     * Obtém o link da próxima página (link opcional)
     *
     * @return String|Null
     */
    public function getNextPageLink()
    {
        if (isset($this->links[self::ROOT][self::NEXT][self::HREF])) {
            return $this->links[self::ROOT][self::NEXT][self::HREF];
        }

        return;
    }

    /**
     * Obtém o link da última página
     *
     * @return String
     */
    public function getLastPageLink()
    {
        return $this->links[self::ROOT][self::LAST][self::HREF];
    }

    /**
     * Obtém o link da primeira página
     *
     * @return String
     */
    public function getFirstPageLink()
    {
        return $this->links[self::ROOT][self::FIRST][self::HREF];
    }
}
