<?php
namespace ApigilityClient;

return array(
    'aliases' => array(
        'ApigilityClient\Service\Endpoint' => 'apigility.client.endpoint',
    ),
    'factories' => array(
        'apigility.client.endpoint' => function ($sm) {
            $config = $sm->get('config');
            $apiServerConfig = $config['api-server'];

            $zendHttpClient = new \Zend\Http\Client;
            $zendHttpClient->getUri()->setHost($apiServerConfig['host']);

            $service = new Service\Endpoint;
            $service->setClient(new Http\Client($zendHttpClient));

            if (isset($apiServerConfig['default_version'])) {
                $service->setVersion($apiServerConfig['default_version']);
            }

            return $service;
        }
    ),
    'invokables' => array(
    ),
    'shared' => array(
    ),
);
