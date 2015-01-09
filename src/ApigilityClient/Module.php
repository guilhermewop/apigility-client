<?php
namespace ApigilityClient;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface,
    Zend\ModuleManager\Feature\LocatorRegisteredInterface,
    Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements
    AutoloaderProviderInterface,
    LocatorRegisteredInterface,
    ConfigProviderInterface
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__.'/../../autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__.'/../../src/'.str_replace('\\', '/', __NAMESPACE__),
                ),
            )
        );
    }

    public function getConfig()
    {
        return include __DIR__.'/../../config/module.config.all.php';
    }

}
