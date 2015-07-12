<?php
namespace T4webPagesTest\Unit\Page\Service;

use T4webBaseTest\Factory\AbstractServiceFactoryTest;
use T4webPages\Page\Service\CreateServiceFactory;
use T4webPages\Page\InputFilter\Create as CreateInputFilter;

class CreateServiceFactoryTest extends AbstractServiceFactoryTest
{
    public function testFactory() {
        $factory = new CreateServiceFactory();

        $eventManagerMock = $this->getMock('Zend\EventManager\EventManager');
        $eventManagerMock->expects($this->once())
            ->method('addIdentifiers')
            ->with($this->equalTo('T4webPages\Page\Service\Create'));

        $this->serviceManager->setService(
            'T4webPages\Page\InputFilter\Create',
            new CreateInputFilter()
        );
        $this->serviceManager->setService(
            'T4webPages\Page\Repository\DbRepository',
            $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')->disableOriginalConstructor()->getMock()
        );
        $this->serviceManager->setService(
            'T4webPages\Page\Factory\EntityFactory',
            $this->getMock('T4webBase\Domain\Factory\EntityFactoryInterface')
        );
        $this->serviceManager->setService('EventManager', $eventManagerMock);

        $this->assertInstanceOf('T4webPages\Page\Service\Create', $factory->createService($this->serviceManager));
    }

}