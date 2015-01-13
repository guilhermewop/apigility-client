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
     * @param  Zend\Http\Client                                   $client
     * @param  Zend\Http\Response                                 $response
     * @param  string|null                                        $message
     * @throws ApigilityClient\Exception\RuntimeException
     */
    public function __construct(ZendHttpClient $client, ZendHttpResponse $response, $message = null)
    {
        $defaultMessage = 'The API response is not an expected response';
        $message        = (string) $message;
        $message        = (empty($message)) ? $defaultMessage : $defaultMessage . PHP_EOL . $message;

        throw new RuntimeException(sprintf(
            $message . ': ' . PHP_EOL .
            'Request  -> Uri: %s ' . PHP_EOL .
            'Request  -> GET params: %s ' . PHP_EOL .
            'Request  -> POST params: %s ' . PHP_EOL .
            'Response -> HTTP code: %s ' . PHP_EOL .
            'Response -> Body: %s',
            $client->getMethod() . ' ' . $client->getUri()->toString(),
            $client->getRequest()->getQuery()->toString(),
            $client->getRequest()->getPost()->toString(),
            $response->getStatusCode(),
            $response->getBody()
        ));
    }
}
