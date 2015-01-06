<?php
namespace GwopApigilityClient\Service;

use Zend\ServiceManager\AbstractFactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

use ReflectionClass,
    ReflectionException;

class ServiceAbstractFactory implements AbstractFactoryInterface
{
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceManager, $name, $requestedName)
    {
        try {
            $reflection = new ReflectionClass($requestedName);
        } catch (ReflectionException $e) {
            return false;
        }

        // Só permite criar a instância se for uma "Entity"
        if ($reflection->implementsInterface('Zend\ServiceManager\ServiceManagerAwareInterface')
            && strpos($reflection->getShortName(), 'Entity')) {
            return true;
        }

        return false;
    }

    public function createServiceWithName(ServiceLocatorInterface $serviceManager, $name, $requestedName)
    {
        $instance = new $requestedName;
        $instance->setServiceManager($serviceManager);

        return $instance;
    }
}
