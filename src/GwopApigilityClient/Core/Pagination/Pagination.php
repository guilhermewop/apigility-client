<?php
namespace GwopApigilityClient\Core\Pagination;

use GwopApigilityClient\Core\Pagination\Links;

class Pagination
{

    /**
     * @var \GwopApigilityClient\Core\Pagination\Links
     */
    private $links;

    /**
     * @var Integer
     */
    private $pageCount;

    /**
     * @var Integer
     */
    private $pageSize;

    /**
     * @var Integer
     */
    private $totalItems;

    /**
     * @const String Nome do índice para a quantidade de páginas
     */
    const PAGE_COUNT = 'page_count';

    /**
     * @const String Nome do índice para a quantidade de registros por página
     */
    const PAGE_SIZE = 'page_size';

    /**
     * @const String Nome do índice para a quantidade total de registros
     */
    const TOTAL_ITEMS = 'total_items';

    /**
     * Constructor
     *
     * @param $links          Array|Links Links da paginação
     * @param $paginationInfo Array|Null  Informaçãoes sobre paginação
     * @return void
     */
    public function __construct($links, $paginationInfo = null)
    {
        $this->setLinks($links);

        if (is_array($paginationInfo) && ! empty($paginationInfo)) {
            $this->setPageCount(isset($paginationInfo[self::PAGE_COUNT]) ?: null);
            $this->setPageSize(isset($paginationInfo[self::PAGE_SIZE]) ?: null);
            $this->setTotalItems(isset($paginationInfo[self::TOTAL_ITEMS]) ?: null);
        }
    }

    /**
     * Define a quantidade de páginas
     *
     * @param $input Int
     * @return self
     */
    public function setPageCount($input)
    {
        $this->pageCount = (int) $input;

        return $this;
    }

    /**
     * Obtém a quantidade de páginas
     *
     * @return Int
     */
    public function getPageCount()
    {
        return $this->pageCount;
    }

    /**
     * Define a quantidade de registros por página
     *
     * @param $input Int
     * @return self
     */
    public function setPageSize($input)
    {
        $this->pageSize = (int) $input;

        return $this;
    }

    /**
     * Obtém a quantidade de registros por página
     *
     * @return Int
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * Define a quantidade total de registros
     *
     * @param $input Int
     * @return self
     */
    public function setTotalItems($input)
    {
        $this->totalItems = (int) $input;

        return $this;
    }

    /**
     * Obtém a quantidade total de registros
     *
     * @return Int
     */
    public function getTotalItems()
    {
        return $this->totalItems;
    }

    /**
     * Define o objeto com os links de paginação
     *
     * @param $input Links|Array
     * @return self
     */
    public function setLinks($input)
    {
        // cria uma instância de Links com o array de links
        if (is_array($input)) {
            //print_r($input); exit;
            $input = new Links($input);
        }

        // já é uma instância de Links
        if ($input instanceof Links) {
            $this->links = $input;
        }

        return $this;
    }

    /**
     * Obtém a instãncia de Links
     *
     * @return Links
     */
    public function getLinks()
    {
        return $this->links;
    }
}
