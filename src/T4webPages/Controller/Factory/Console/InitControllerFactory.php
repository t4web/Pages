<?php

namespace T4webPages\Controller\Factory\Console;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use T4webPages\Controller\Console\InitController;

class InitControllerFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $serviceManager = $serviceLocator->getServiceLocator();
        return new InitController(
            $serviceManager->get('Zend\Db\Adapter\Adapter')
        );
    }
}
