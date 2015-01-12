<?php
namespace ApigilityClient\Http\Response\Content;

use Zend\Http\Response as HttpResponse,
    Zend\Http\Client as HttpClient;

interface ContentInterface
{
    public function __construct(HttpClient $client, HttpResponse $response);
}
