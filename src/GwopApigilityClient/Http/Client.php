<?php
namespace GwopApigilityClient\Http;

use Zend\Http\Client as ZendHttpClient,
    Zend\Http\Exception as HttpException,
    Zend\Cache\Storage\Adapter\AbstractAdapter as AbstractCacheAdapter;

use GwopApigilityClient\Http\Client\ClientInterface;

class Client implements ClientInterface
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
    * @param String $method
    * @param Array $headers
    */
    public function doRequest($method = 'GET', $path, $version, array $params = array(), array $headers = array())
    {

    }
}
