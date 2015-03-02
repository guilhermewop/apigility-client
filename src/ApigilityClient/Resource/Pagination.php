<?php
namespace ApigilityClient\Resource;

final class Pagination
{

    const PAGE_SIZE   = 'page_size';
    const PAGE_COUNT  = 'page_count';
    const TOTAL_ITEMS = 'total_items';

    private $pageSize;
    private $pageCount;
    private $totalItems;

    public function __construct(array $data = null)
    {
        if (! empty($data)) {
            $pageSize   = (int) isset($data[self::PAGE_SIZE]) ? $data[self::PAGE_SIZE] : 0;
            $pageCount  = (int) isset($data[self::PAGE_COUNT]) ? $data[self::PAGE_COUNT] : 0;
            $totalItems = (int) isset($data[self::TOTAL_ITEMS]) ? $data[self::TOTAL_ITEMS] : 0;

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
