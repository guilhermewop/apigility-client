<?php
namespace GwopApigilityClient\Service;

class Endpoint
{
    /**
     * @var String Path
     */
    private $path;

    /**
     * @var String Version
     */
    private $version = 1;

    public function __construct($path = null, $version = null)
    {
        $this->setPath($path)
             ->setVersion($version);
    }

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

    public function setPath($input)
    {
        $input = (string) $input;

        // add slash
        if (false === strpos($input, '/', 0)) {
            $input = '/' . $input;
        }

        $this->path = $input;

        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function __toString()
    {
        echo sprintf("%s/%s", $this->version, $this->path);
    }

}
