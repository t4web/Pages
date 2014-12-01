<?php

namespace Pages;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\Controller\ControllerManager;
use Pages\Controller\CreateController;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/', __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
            ),
        );
    }

    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'Pages\Controller\CreateController' => function (ControllerManager $cm) {
                    $sl = $cm->getServiceLocator();
                    return new CreateController(
                        //$sl->get('Authentication\Service')
                    );
                },
            )
        );
    }
}
