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

            $service = new Service\Endpoint;
            $service->setVersion($apiServerConfig['default_version']);

            return $service;
        }
    ),
    'invokables' => array(
    ),
    'shared' => array(
    ),
);
