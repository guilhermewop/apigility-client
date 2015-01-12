<?php
namespace ApigilityClient\Service;

use ApigilityClient\Service\EndpointInterface,
    ApigilityClient\Http\Client,
    ApigilityClient\Exception\NotAvailableException;

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
     * @var ApigilityClient\Http\Client
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

    public function fetch($path = null, array $params = array())
    {
        if (! is_null($path)) {
            $this->setPath($path);
        }

        return $this->getClient()->get($this->getFullPath(), $params);
    }

    public function insert()
    {
        throw new NotAvailableException('Feature not implemented');
    }

    public function update()
    {
        throw new NotAvailableException('Feature not implemented');
    }

    public function delete()
    {
        throw new NotAvailableException('Feature not implemented');
    }

    public function getFullPath()
    {
        return sprintf("/v%s%s", $this->version, $this->path);
    }

    public function __toString()
    {
        return $this->getFullPath();
    }
}
