<?php
namespace T4webPagesTest\Unit\Controller\Factory\Controller\Console;

use T4webBaseTest\Factory\AbstractControllerFactoryTest;
use T4webPages\Controller\Factory\Console\InitControllerFactory;

class InitControllerFactoryTest extends AbstractControllerFactoryTest
{

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