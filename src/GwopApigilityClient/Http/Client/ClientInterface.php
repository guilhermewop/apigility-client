<?php
namespace GwopApigilityClient\Http\Client;

interface ClientInterface
{
    public function doRequest($method, $path, $version, array $params = array(), array $headers = array());
}
