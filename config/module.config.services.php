<?php
namespace ApigilityClient;

return array(
    'aliases' => array(
        'ApigilityClient\Http\Client' => 'apigility.client',
    ),
    'factories' => array(
        'apigility.client' => function ($sm) {
            $config = $sm->get('config');
            $clientConfig = $config['http_client'];

            $client = new \Zend\Http\Client($clientConfig['uri'], $clientConfig['options']);
            $client->getRequest()->getHeaders()->addHeaders($clientConfig['headers']);

            return new Http\Client($client);
        }
    ),
    'invokables' => array(
    ),
    'shared' => array(
        'apigility.client' => false,
    ),
);
