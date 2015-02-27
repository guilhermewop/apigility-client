<?php
namespace ApigilityClient\Http\Client;

interface GetInterface
{
    const METHOD = 'GET';

    public function get(array $params);
}
