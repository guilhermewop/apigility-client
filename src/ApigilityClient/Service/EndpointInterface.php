<?php
namespace ApigilityClient\Service;

interface EndpointInterface
{
    public function setVersion($input);

    public function getVersion();

    public function setPath($input);

    public function getPath();

    public function fetch($path, array $params = array());

    public function insert();

    public function update();

    public function delete();
}
