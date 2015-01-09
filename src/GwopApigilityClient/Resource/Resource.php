<?php
namespace GwopApigilityClient\Resource;

class Resource
{

    private $data;
    private $pagination;

    public function __construct(array $data = null)
    {
        if (! empty($data)) {
            $this->setData($data);
        }
    }

    public function setData(array $input)
    {
        $this->data = $input;

        $this->setPagination(new Pagination($this->data));

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
