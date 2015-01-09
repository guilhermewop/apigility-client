<?php
namespace GwopApigilityClient\Resource;

final class Pagination
{

    const KEY_PAGE_SIZE   = 'page_size';
    const KEY_PAGE_COUNT  = 'page_count';
    const KEY_TOTAL_ITEMS = 'total_items';

    private $pageSize;
    private $pageCount;
    private $totalItems;

    public function __construct(array $data = null)
    {
        if (! empty($data)) {
            $pageSize   = (int) $data[self::KEY_PAGE_SIZE];
            $pageCount  = (int) $data[self::KEY_PAGE_COUNT];
            $totalItems = (int) $data[self::KEY_TOTAL_ITEMS];

            $this->setPageSize($pageSize)
                 ->setPageCount($pageCount)
                 ->setTotalItems($totalItems);
        }
    }

    public function setPageSize($input)
    {
        $input = (int) $input;
        $this->pageSize = $input;

        return $this;
    }

    public function getPageSize()
    {
        return $this->pageSize;
    }

    public function setPageCount($input)
    {
        $input = (int) $input;
        $this->pageCount = $input;

        return $this;
    }

    public function getPageCount()
    {
        return $this->pageCount;
    }

    public function setTotalItems($input)
    {
        $input = (int) $input;
        $this->totalItems = $input;

        return $this;
    }

    public function getTotalItems()
    {
        return $this->totalItems;
    }

}
