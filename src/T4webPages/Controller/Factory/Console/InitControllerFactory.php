<?php

namespace T4webPages\Controller\Factory\Console;

use Zend\ServiceManager\FactoryInterface;
use Zend\Mvc\Controller\ControllerManager;
use T4webPages\Controller\Console\InitController;

class InitControllerFactory implements FactoryInterface {

    public function createService(ControllerManager $controllerManager) {
        $serviceLocator = $controllerManager->getServiceLocator();
        return new InitController(
            $serviceLocator->get('Zend\Db\Adapter\Adapter')
        );
    }
}
