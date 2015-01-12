<?php
namespace ApigilityClient\Http;

use ApigilityClient\Exception\RuntimeException,
    ApigilityClient\Http\Response\Content\HalJson;

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
    public function __construct(HttpClient $client, HttpResponse $response)
    {
        $this->httpClient = $client;
        $this->httpResponse = $response;

        try {
            $this->checkResponseStatus();

            $contentType = $this->httpResponse->getHeaders()->get('Content-Type')->getFieldValue();
            list($mimeType, $charset) = explode(';', $contentType);

            switch (trim($mimeType)) {
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
        } catch (RuntimeException $e) {
            die($e->getMessage());
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
