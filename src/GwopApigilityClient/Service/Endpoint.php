<?php
namespace GwopApigilityClient\Service;

use GwopApigilityClient\Http\Client;

class Endpoint implements EndpointInterface
{
    /**
     * @var String Path
     */
    private $path = '/';

    /**
     * @var String Version
     */
    private $version = 1;

    /**
     * @var GwopApigilityClient\Http\Client
     */
    private $client;

    public function __construct($path = null, $version = null, Client $client = null)
    {
        $client = ($client instanceof Client) ? $client : new Client();

        $this->setPath($path)
             ->setVersion($version)
             ->setClient($client);
    }

    public function setClient(Client $input)
    {
        $this->client = $input;

        return $this;
    }

    public function getClient()
    {
        return $this->client;
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

    public function get($path = null, $version = null, array $params = array())
    {
        if (! is_null($path)) {
            $this->setPath($path);
        }

        if (! is_null($version)) {
            $this->setVersion($version);
        }

        return $this->getClient()->doRequest($this, 'GET', $params);
    }

    public function __toString()
    {
        return sprintf("/v%s%s", $this->version, $this->path);
    }

}
