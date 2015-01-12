<?php
namespace ApigilityClient\Resource;

use Level3\Resource\Resource as Level3Resource,
    Level3\Resource\Link as Level3Link;
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
        $links = $this->resource->getAllLinks();
        $links['self'] = new Level3Link($this->resource->getUri());

        return new Links($links);
    }

    public function getContent($key = self::DEFAULT_KEY_EMBEDDED_CONTENT)
    {
        return $this->resource->getResources($key);
    }

}
