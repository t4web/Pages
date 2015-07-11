<?php

namespace T4webPages;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Console\Adapter\AdapterInterface as ConsoleAdapterInterface;
use Zend\Mvc\Controller\ControllerManager;
use T4webPages\Controller\CreateController;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface, ServiceProviderInterface,
                        ControllerProviderInterface, ConsoleUsageProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getConsoleUsage(ConsoleAdapterInterface $console)
    {
        return array(
            'pages init' => 'Initialize module',
        );
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
                'T4webPages\Controller\Console\Init' => 'T4webPages\Controller\Factory\Console\InitControllerFactory',
                'T4webPages\Controller\Admin\PageController' => 'T4webPages\Controller\Factory\Admin\PageControllerFactory',
            )
        );
    }
}
