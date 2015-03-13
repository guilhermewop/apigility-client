<?php
namespace ApigilityClient\Http\Response\Content;

use Zend\Http\Response as HttpResponse,
    Zend\Http\Client as HttpClient;

use ApiClient\Core\Response\TriggerException;

final class EmptyContent extends AbstractContent
{
    const CONTENT_TYPE = 'text/html';

    public function __construct(HttpClient $client, HttpResponse $response)
    {
        $this->content = '';
    }

}
