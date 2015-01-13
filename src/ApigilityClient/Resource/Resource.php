<?php
namespace ApigilityClient\Resource;

use Level3\Resource\Resource as Level3Resource,
    Level3\Resource\Link as Level3Link;

use ApigilityClient\Exception\RuntimeException,
    ApigilityClient\Resource\Pagination,
    ApigilityClient\Resource\Content;


class Resource
{

    private $resource;
    private $pagination;

    private $collection = false;

    public function __construct(Level3Resource $resource = null)
    {
        if (! empty($resource)) {
            $this->setResource($resource);
        }
    }

    public function setResource(Level3Resource $input)
    {
        $this->resource = $input;

        $data = $this->resource->getData();

        if (isset($data[Pagination::PAGE_SIZE])
            && isset($data[Pagination::PAGE_COUNT])
            && isset($data[Pagination::TOTAL_ITEMS])
        ) {
            $this->collection = true;
        }

        if ($this->collection) {
            $this->setPagination(new Pagination($data));
        }

        return $this;
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function isCollection()
    {
        return ($this->collection);
    }

    private function setPagination(Pagination $input)
    {
        $this->pagination = $input;

        return $this;
    }

    public function getPagination()
    {
        if (! $this->collection) {
            throw new RuntimeException('Trying getting pagination data from not a collection');
        }

        return $this->pagination;
    }

    public function getLinks()
    {
        $links = $this->resource->getAllLinks();
        $links['self'] = new Level3Link($this->resource->getUri());

        return new Links($links);
    }

}
