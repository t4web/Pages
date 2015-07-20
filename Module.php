<?php

namespace T4webPages;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Console\Adapter\AdapterInterface as ConsoleAdapterInterface;

class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    ServiceProviderInterface,
    ControllerProviderInterface,
    ConsoleUsageProviderInterface
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
                'T4webPages\Page\Service\Create' => 'T4webPages\Page\Service\CreateServiceFactory',
                'T4webPages\Page\Service\Finder' => 'T4webPages\Page\Service\FinderServiceFactory',
            ),
            'invokables' => array(
                'T4webPages\Controller\Admin\PageViewModel' => 'T4webPages\Controller\Admin\PageViewModel',
                'T4webPages\Controller\Admin\ListViewModel' => 'T4webPages\Controller\Admin\ListViewModel',

                'T4webPages\Page\InputFilter\Create' => 'T4webPages\Page\InputFilter\Create',
            ),
        );
    }

    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'T4webPages\Controller\Console\Init' => 'T4webPages\Controller\Factory\Console\InitControllerFactory',
            ),
            'invokables' => array(
                'T4webPages\Controller\Admin\PageController' => 'T4webPages\Controller\Admin\PageController',
                'T4webPages\Controller\Admin\PagesController' => 'T4webPages\Controller\Admin\PagesController',
            ),
        );
    }
}
