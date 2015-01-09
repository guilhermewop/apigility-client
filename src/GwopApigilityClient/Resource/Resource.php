<?php
namespace GwopApigilityClient\Resource;

use Level3\Resource\Resource as Level3Resource;

class Resource
{

    private $resource;
    private $pagination;

    const DEFAULT_KEY_EMBEDDED_CONTENT = 'content';

    public function __construct(Level3Resource $resource = null)
    {
        if (! empty($resource)) {
            $this->setResource($resource);
        }
    }

    public function setResource(Level3Resource $input)
    {
        $this->resource = $input;

        $this->setPagination(new Pagination($this->resource->getData()));

        return $this;
    }

    public function getResource()
    {
        return $this->resource;
    }

    private function setPagination(Pagination $input)
    {
        $this->pagination = $input;

        return $this;
    }

    public function getPagination()
    {
        return $this->pagination;
    }

    public function getLinks()
    {
        return new Links($this->resource->getAllLinks());
    }

    public function getContent($key = self::DEFAULT_KEY_EMBEDDED_CONTENT)
    {
        return $this->resource->getResources($key);
    }

}
