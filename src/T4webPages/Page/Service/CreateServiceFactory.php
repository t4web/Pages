<?php

namespace T4webPages\Page\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CreateServiceFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceManager) {
        $eventManager = $serviceManager->get('EventManager');
        $eventManager->addIdentifiers('T4webPages\Page\Service\Create');

        return new Create(
            $serviceManager->get('T4webPages\Page\InputFilter\Create'),
            $serviceManager->get('T4webPages\Page\Repository\DbRepository'),
            $serviceManager->get('T4webPages\Page\Factory\EntityFactory'),
            $eventManager
        );
    }
}