<?php
namespace T4webPagesTest\Unit\Controller\Factory\Controller\Console;

use Zend\ServiceManager\ServiceManager;
use T4webPages\Controller\Factory\Console\InitControllerFactory;

class InitControllerFactoryTest extends \PHPUnit_Framework_TestCase
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
        $factory = new InitControllerFactory();

        $this->serviceManager->setService(
            'Zend\Db\Adapter\Adapter',
            $this->getMockBuilder('Zend\Db\Adapter\Adapter')->disableOriginalConstructor()->getMock()
        );

        $this->assertInstanceOf(
            'T4webPages\Controller\Console\InitController',
            $factory->createService($this->controllerManager)
        );
    }

}