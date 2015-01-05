<?php
namespace GwopApigilityClient;

return array(
    'aliases' => array(
    ),
    'factories' => array(
         'gwop.api.http.client' => function ($sm) {
            $config = $sm->get('config');
            $apigilityServerConfig = $config['api-server'];

            $httpClient = new \Zend\Http\Client();
            $host = "{$apigilityServerConfig['host']}/{$apigilityServerConfig['version']}";
            $httpClient->getUri()->setHost($host);

            return $httpClient;
        }
    ),
    'invokables' => array(
    ),
    'shared' => array(
    ),
);
