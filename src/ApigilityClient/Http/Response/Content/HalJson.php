<?php
namespace ApigilityClient\Http\Response\Content;

use Zend\Json\Json,
    Zend\Http\Response as HttpResponse,
    Zend\Http\Client as HttpClient;

use ApiClient\Core\Response\TriggerException;

use Level3\Resource\Format\Reader\HAL\JsonReader;

final class HalJson extends AbstractContent
{
    const CONTENT_TYPE = 'application/hal+json';

    public function __construct(HttpClient $client, HttpResponse $response)
    {
        $halJsonReader = new JsonReader;
        $this->content = new Resource($halJsonReader->execute($response->getBody()));
    }

}
