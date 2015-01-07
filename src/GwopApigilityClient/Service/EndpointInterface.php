<?php
namespace GwopApigilityClient\Service;

interface EndpointInterface
{
    public function setVersion($input);

    public function getVersion();

    public function setPath($input);

    public function getPath();

    public function get($path = null, $version = null, array $params = array());
}
