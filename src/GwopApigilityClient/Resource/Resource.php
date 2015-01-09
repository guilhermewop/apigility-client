<?php
namespace GwopApigilityClient\Resource;

use Level3\Resource\Resource as Level3Resource;

class Resource
{

    private $data;
    private $pagination;

    public function __construct(Level3Resource $data = null)
    {
        if (! empty($data)) {
            $this->setData($data);
        }
    }

    public function setData(Level3Resource $input)
    {
        $this->data = $input;

        $this->setPagination(new Pagination($this->data->getData()));

        return $this;
    }

    public function getData()
    {
        return $this->data;
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

}
