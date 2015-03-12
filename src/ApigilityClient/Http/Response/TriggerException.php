<?php
namespace ApigilityClient\Http\Response;

use Zend\Http\Client as ZendHttpClient,
    Zend\Http\Response as ZendHttpResponse;

use ApigilityClient\Exception\RuntimeException;

class TriggerException
{

    /**
     * Throws an exception
     *
     * @param  Zend\Http\Client   $client
     * @param  Zend\Http\Response $response
     * @param  string|null        $message
     * @throws ApigilityClient\Exception\RuntimeException
     */
    public function __construct(ZendHttpClient $client, ZendHttpResponse $response, $message = null)
    {
        $error = json_decode($response->getBody());

        throw new RuntimeException(sprintf(
            'Erro "%s/%s". %s',
            $error->status,
            $error->title,
            $error->detail
        ));
    }
}
