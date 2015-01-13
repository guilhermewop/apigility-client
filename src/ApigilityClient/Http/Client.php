<?php
namespace ApigilityClient\Http;

use ApigilityClient\Exception\RuntimeException,
    ApigilityClient\Http\Response,
    ApigilityClient\Http\Client\ClientInterface;

use Zend\Http\Client as ZendHttpClient;

final class Client implements ClientInterface
{

    /**
     * @const Int Timeout for each request
     */
    const TIMEOUT = 60;

    /**
     * @var Zend\Http\Client Instance
     */
    private $zendHttpClient;

    private $headers = array(
        'Accept' => 'application/hal+json',
    );

    public function __construct(ZendHttpClient $client = null)
    {
        $client = ($client instanceof ZendHttpClient) ? $client : new ZendHttpClient();

        $this->setZendHttpClient($client);
    }

    public function setZendHttpClient(ZendHttpClient $client)
    {
        $client->getRequest()->getHeaders()->addHeaders($this->headers);

        $client->setOptions(array(
            'timeout' => self::TIMEOUT,
        ));

        $this->zendHttpClient = $client;
    }

    /**
     * Get the Zend\Http\Client instance
     *
     * @return Zend\Http\Client
     */
    public function getZendHttpClient()
    {
        return $this->zendHttpClient;
    }

    /**
     * Execute the request to api server
     *
     * @param String $path Eg: "/v1/endpoint"
     * @param String $method HTTP Verb
     * @param Array $params GET or POST params
     */
    private function doRequest($path, $method = 'GET', array $params = array())
    {
        $host = $this->zendHttpClient->getUri()->getHost();

        if (empty($host)) {
            throw new RuntimeException(
                'Host not defined.'
            );
        }

        $this->zendHttpClient->getUri()->setPath($path);

        if ('GET' === $method) {
            if (! empty($params)) {
                $this->zendHttpClient->setParameterGet($params);
            }
        } else {
            throw new RuntimeException(sprintf(
                'Method "%s" not allowed',
                $method
            ));
        }

        $this->zendHttpClient->setMethod($method);

        $zendHttpResponse = $this->zendHttpClient->send();

        try {
            $response = new Response($this->zendHttpClient, $zendHttpResponse);
            $content = $response->getContent();
        } catch (\Zend\Http\Exception\RuntimeException $e) {
            die($e->getMessage());
        }

        return $content;
    }

    /**
     * {@inheritdoc}
     */
    public function get($path, array $data = array())
    {
        return $this->doRequest($path, 'GET', $data);
    }

    /**
     * {@inheritdoc}
     */
    public function post($path, array $data)
    {
        throw new RuntimeException('Function not implemented');
    }

    /**
     * {@inheritdoc}
     */
    public function put($path, array $data)
    {
        throw new RuntimeException('Function not implemented');
    }

    /**
     * {@inheritdoc}
     */
    public function delete($path)
    {
        throw new RuntimeException('Function not implemented');
    }

    /**
     * {@inheritdoc}
     */
    public function patch($path, array $data)
    {
        throw new RuntimeException('Function not implemented');
    }

}
