<?php

namespace T4webPages\Controller\Factory\Admin;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use T4webPages\Controller\Admin\PageController;

class PageControllerFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $serviceManager = $serviceLocator->getServiceLocator();
        return new PageController(
            //$serviceManager->get('Zend\Db\Adapter\Adapter')
        );
    }
}