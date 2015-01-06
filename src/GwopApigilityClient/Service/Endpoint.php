<?php
namespace GwopApigilityClient\Service;

class Endpoint
{
    /**
     * @var String Version
     */
    private $version = 1;

    public function setVersion($input)
    {
        $input = (int) $input;

        if ($input >= 1) {
            $this->version = $input;
        }

        return $this;
    }

    public function getVersion()
    {
        return $this->version;
    }

}
