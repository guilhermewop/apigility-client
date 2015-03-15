<?php
namespace ApigilityClient\Http;

use Zend\Http\Client as ZendHttpClient,
    Zend\Http\Response as ZendHttpResponse;

use ApigilityClient\Exception\RuntimeException,
    ApigilityClient\Http\Response\TriggerException,
    ApigilityClient\Http\Response\Content\HalJson,
    ApigilityClient\Http\Response\Content\EmptyContent;

final class Response
{
    /**
     * @var Zend\Http\Client
     */
    private $httpClient;

    /**
     * @var Zend\Http\Response
     */
    private $httpResponse;

    /**
     * @var ApiClient\Http\Response\Content\ContentInterface
     */
    private $strategyContent;

    /**
    * Construtor
    *
    * @param Zend\Http\Client   $client
    * @param Zend\Http\Response $response
    */
    public function __construct(ZendHttpClient $client, ZendHttpResponse $response)
    {
        $this->httpClient = $client;
        $this->httpResponse = $response;

        try {
            $this->checkResponseStatus();

            if (204 == $this->httpResponse->getStatusCode()) {
                $this->strategyContent = new EmptyContent($this->httpClient, $this->httpResponse);
            } else {
                $contentType = $this->httpResponse->getHeaders()->get('Content-Type')->getFieldValue();

                switch (trim($contentType)) {
                    case HalJson::CONTENT_TYPE :
                        $this->strategyContent = new HalJson($this->httpClient, $this->httpResponse);
                        break;

                    default :
                        $errorMessage = sprintf(
                            'The apigility server returned a mime type ("%s") that cannot be parsed by apigility client',
                            $mimeType
                        );

                    return new TriggerException($this->httpClient, $this->httpResponse, $errorMessage);
                }
            }

        } catch (RuntimeException $e) {
	   throw $e;
        }
    }

    /**
     * Get the content
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->strategyContent->getContent();
    }

    /**
     * Check response status
     *
     * @throws ApigilityClient\Exception\RuntimeException
     * @return Bool
     */
    private function checkResponseStatus()
    {
        if (! $this->httpResponse->isSuccess()) {
            return new TriggerException($this->httpClient, $this->httpResponse);
        }

        return true;
    }
}
