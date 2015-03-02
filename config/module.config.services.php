<?php
namespace ApigilityClient;

return array(
    'aliases' => array(
        'ApigilityClient\Http\Client' => 'apigility.client',
    ),
    'factories' => array(
        'apigility.client' => function ($sm) {
            $config = $sm->get('config');
            $apiConfig = $config['api-server'];

            return new Http\Client(new \Zend\Http\Client($apiConfig['host']));
        }
    ),
    'invokables' => array(
    ),
    'shared' => array(
        'apigility.client' => false,
    ),
);
