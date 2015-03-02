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
    private $zendClient;

    public function __construct(ZendHttpClient $client = null)
    {
        $client = ($client instanceof ZendHttpClient) ? $client : new ZendHttpClient();

        $this->setZendClient($client);
    }

    public function setZendClient(ZendHttpClient $client)
    {
        $client->getRequest()->getHeaders()->addHeaders(array(
            'Accept'       => 'application/hal+json',
            'Content-Type' => 'application/json',
        ));

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

        $this->zendClient = $client;

        return $this;
    }

    /**
     * Get the Zend\Http\Client instance
     *
     * @return Zend\Http\Client
     */
    public function getZendClient()
    {
        return $this->zendClient;
    }

    /**
     * Perform the request to api server
     *
     * @param String $path Example: "/v1/endpoint"
     * @param Array $headers
     */
    private function doRequest($path, $headers = array())
    {
        $this->zendClient->getUri()->setPath($path);

        $this->zendClient->getRequest()->getHeaders()->addHeaders($headers);

        $zendHttpResponse = $this->zendClient->send();

        try {
            $response = new Response($this->zendClient, $zendHttpResponse);
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
        $this->zendClient->setMethod('GET')
                         ->setParameterGet($data);

        return $this->doRequest($path, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function post($path, array $data, array $headers = array())
    {
        $this->zendClient->setMethod('POST')
                         ->setRawBody(json_encode($data));

        return $this->doRequest($path, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function put($path, array $data, array $headers = array())
    {
        $this->zendClient->setMethod('PUT')
                         ->setRawBody(json_encode($data));

        return $this->doRequest($path, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function patch($path, array $data, array $headers = array())
    {
        $this->zendClient->setMethod('PATCH')
                         ->setRawBody(json_encode($data));

        return $this->doRequest($path, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($path, array $headers = array())
    {
        $this->zendClient->setMethod('DELETE');

        return $this->doRequest($path, $headers);
    }

}
