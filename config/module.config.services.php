<?php
namespace GwopApigilityClient;

return array(
    'aliases' => array(
        'GwopApigilityClient\Service\Endpoint' => 'gwop.apigility.endpoint',
    ),
    'factories' => array(
        'gwop.apigility.endpoint' => function ($sm) {
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
        'gwop.apigility.endpoint' => false,
    ),
);
