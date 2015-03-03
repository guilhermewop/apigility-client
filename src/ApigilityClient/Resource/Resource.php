<?php
namespace ApigilityClient\Resource;

use Level3\Resource\Resource as Level3Resource,
    Level3\Resource\Link as Level3Link;

use ApigilityClient\Exception\RuntimeException,
    ApigilityClient\Resource\Pagination,
    ApigilityClient\Resource\Content;


class Resource
{
    private $uri = '';

    private $pagination;

    private $links;

    private $data = array();

    public function __construct(Level3Resource $resource)
    {
        $this->config($resource);
    }

    private function config(Level3Resource $resource)
    {
        $this->setUri($resource->getUri());
        $this->setLinks($resource->getAllLinks());
        $this->setPagination($resource->getData());
        $this->setData($resource);
    }

    private function setUri($input)
    {
        $this->uri = (string) $input;

        return $this;
    }

    public function getUri()
    {
        return $this->uri;
    }

    private function setLinks(array $links)
    {
        $links['self'] = new Level3Link($this->uri);

        $this->links = new Links($links);

        return $this;
    }

    public function getLinks()
    {
        return $this->links;
    }

    private function setPagination(array $input)
    {
        $this->pagination = new Pagination($input);

        return $this;
    }

    public function getPagination()
    {
        return $this->pagination;
    }

    public function isCollection()
    {
        return (bool) ($this->pagination->getPageSize() > 0);
    }

    private function setData(Level3Resource $input)
    {
        if ($this->isCollection()) {
            $resources = $input->getAllResources();
            foreach ($resources as $keyContent) {
                foreach ($keyContent as $resource) {
                    $this->data[] = $resource->getData();
                }
            }
        } else {
            $this->data[] = $input->getData();
        }

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

}
