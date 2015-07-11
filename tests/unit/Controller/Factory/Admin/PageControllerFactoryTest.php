<?php
namespace T4webPagesTest\Unit\Controller\Factory\Controller\Admin;

use Zend\ServiceManager\ServiceManager;
use T4webPages\Controller\Factory\Admin\PageControllerFactory;

class PageControllerFactoryTest extends \PHPUnit_Framework_TestCase
{

    /** @var ServiceManager  */
    protected $serviceManager;
    protected $controllerManager;

    public function setUp() {
        $this->serviceManager = new ServiceManager();
        $this->controllerManager = $this->getMock('Zend\Mvc\Controller\ControllerManager');
        $this->controllerManager->expects($this->once())
            ->method('getServiceLocator')
            ->will($this->returnValue($this->serviceManager));
    }

    public function testFactory() {
        $factory = new PageControllerFactory();

        $this->assertInstanceOf(
            'T4webPages\Controller\Admin\PageController',
            $factory->createService($this->controllerManager)
        );
    }

}