<?php
namespace GwopApigilityClient\Http;

use Zend\Http\Client as ZendHttpClient,
    Zend\Http\Exception as HttpException,
    Zend\Cache\Storage\Adapter\AbstractAdapter as AbstractCacheAdapter;

use GwopApigilityClient\Service\Endpoint;

class Client
{
    /**
     * @const Int Timeout for each request
     */
    const TIMEOUT = 60;

    private $httpClient;

    public function __construct(ZendHttpClient $client = null)
    {
        $client = ($client instanceof ZendHttpClient) ? $client : new ZendHttpClient();

        $this->setZendHttpClient($client);
    }

    public function setZendHttpClient(ZendHttpClient $client)
    {
        // x_forwarded_for
        $xff = array($_SERVER['REMOTE_ADDR']);

        if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])
            && $_SERVER['HTTP_X_FORWARDED_FOR'] != $_SERVER['REMOTE_ADDR']) {
            array_unshift($xff, $_SERVER['HTTP_X_FORWARDED_FOR']);
        }

        $client->getRequest()->getHeaders()->addHeaders(array(
            'HTTP_X_FORWARDED_FOR' => implode(',', $xff),
        ));

        $client->setOptions(array('timeout' => self::TIMEOUT));

        $this->httpClient = $client;
    }

    /**
     * Get http client instance
     *
     * @return Zend\Http\Client
     */
    public function getZendHttpClient()
    {
        return $this->httpClient;
    }

   /**
    * Execute the request to server
    *
    * @param GwopApigilityClient\Service\Endpoint $endpoint
    * @param String $method HTTP Verb
    * @param Array $params
    * @param Array $headers
    */
    protected function doRequest(Endpoint $endpoint, $method = 'GET', array $params = array(), array $headers = array())
    {
        $host = $this->httpClient->getUri()->getHost();

        if (empty($host)) {
            throw new HttpException\RuntimeException(
                'Host not defined.'
            );
        }

        $version = $endpoint->getVersion();
        $path    = $endpoint->getpath();

        $this->httpClient->getUri()->setPath("v{$version}{$path}");

        if ('GET' === $method) {
            if (! empty($params)) {
                $this->httpClient->setParameterGet($params);
            }
        } else {
            throw new HttpException\RuntimeException(sprintf(
                'Method "%s" not allowed',
                $method
            ));
        }

        $this->httpClient->setMethod($method);

        $httpResponse = $this->httpClient->send();

        try {
            $response = new Response($this->httpClient, $httpResponse);
            $content = $response->getContent();
        } catch (\Zend\Http\Exception\RuntimeException $e) {
            die($e->getMessage());
        }

        return $content;
    }

}
