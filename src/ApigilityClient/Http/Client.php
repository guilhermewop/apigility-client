<?php
namespace ApigilityClient\Http;

use ApigilityClient\Exception\RuntimeException,
    ApigilityClient\Http\Response,
    ApigilityClient\Http\Client\ClientInterface;

use Zend\Http\Client as ZendHttpClient,
    Zend\Http\Client\Adapter\Curl,
    Zend\Http\Exception\RuntimeException as ZendHttpRuntimeException;

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

    public function __construct(ZendHttpClient $client = null)
    {
        $client = ($client instanceof ZendHttpClient) ? $client : new ZendHttpClient();

        $this->setZendHttpClient($client);
    }

    public function setZendHttpClient(ZendHttpClient $client)
    {
        $client->setOptions(array(
            'timeout' => self::TIMEOUT,
        ));

        $client->setAdapter(new Curl);

        $host = $client->getUri()->getHost();

        if (empty($host)) {
            throw new ZendHttpRuntimeException(
                'Host not defined.'
            );
        }

        $this->zendHttpClient = $client;

        $this->addHeaders(array(
            'Accept'       => 'application/hal+json',
            'Content-Type' => 'application/json',
        ));

        return $this;
    }

    private function addHeaders(array $headers = array())
    {
        if (! empty($headers)) {
            $this->zendHttpClient->getRequest()->getHeaders()->addHeaders($headers);
        }

        return $this;
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
     * Perform the request to api server
     *
     * @param String $path Example: "/v1/endpoint"
     * @param String $method HTTP method (GET, POST, PUT, DELETE...)
     * @param Array $params Query string or post params
     * @param Array $headers GET or POST params
     */
    private function doRequest($path)
    {
        $this->zendHttpClient->getUri()->setPath($path);

        $zendHttpResponse = $this->zendHttpClient->send();

        try {
            $response = new Response($this->zendHttpClient, $zendHttpResponse);
            $content = $response->getContent();
        } catch (ZendHttpRuntimeException $e) {
            die($e->getMessage());
        }

        return $content;
    }

    /**
     * {@inheritdoc}
     */
    public function get($path, array $data = array(), array $headers = array())
    {
        $this->addHeaders($headers);

        $this->zendHttpClient->setMethod('GET')
                             ->setParameterGet($data);

        return $this->doRequest($path);
    }

    /**
     * {@inheritdoc}
     */
    public function post($path, array $data, array $headers = array())
    {
        $this->addHeaders($headers);

        $this->zendHttpClient->setMethod('POST')
                             ->setRawBody(json_encode($data));

        return $this->doRequest($path);
    }

    /**
     * {@inheritdoc}
     */
    public function put($path, array $data, array $headers = array())
    {
        $this->addHeaders($headers);

        $this->zendHttpClient->setMethod('PUT')
                             ->setRawBody(json_encode($data));

        return $this->doRequest($path);
    }

    /**
     * {@inheritdoc}
     */
    public function patch($path, array $data, array $headers = array())
    {
        $this->addHeaders($headers);

        $this->zendHttpClient->setMethod('PATCH')
                             ->setRawBody(json_encode($data));

        return $this->doRequest($path);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($path, array $headers = array())
    {
        $this->addHeaders($headers);

        $this->zendHttpClient->setMethod('DELETE');

        return $this->doRequest($path);
    }

}
