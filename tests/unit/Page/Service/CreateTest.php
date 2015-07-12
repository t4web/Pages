<?php
namespace T4webPagesTest\Unit\Page\Service;

use T4webPages\Page\Service\Create;
use T4webPages\Page\Page;

class CreateTest extends \PHPUnit_Framework_TestCase
{
    private $service;
    private $inputFilterCreateMock;
    private $dbRepositoryMock;
    private $entityFactoryMock;
    private $eventManagerMock;

    private $data = array(
        'title' => 'a',
        'body' => 'b',
    );

    public function setUp() {
        $this->inputFilterCreateMock = $this->getMock('T4webPages\Page\InputFilter\Create');
        $this->dbRepositoryMock = $this->getMockBuilder('T4webBase\Domain\Repository\DbRepository')
            ->disableOriginalConstructor()
            ->getMock();
        $this->entityFactoryMock = $this->getMock('T4webBase\Domain\Factory\EntityFactoryInterface');
        $this->eventManagerMock = $this->getMock('Zend\EventManager\EventManager');

        $this->service = new Create(
            $this->inputFilterCreateMock,
            $this->dbRepositoryMock,
            $this->entityFactoryMock,
            $this->eventManagerMock
        );
    }

    public function testCreate_NotIsValid_ReturnNull() {
        $this->inputFilterCreateMock->expects($this->once())
            ->method('setData')
            ->with($this->equalTo($this->data));

        $this->inputFilterCreateMock->expects($this->once())
            ->method('isValid')
            ->willReturn(false);

        $this->inputFilterCreateMock->expects($this->once())
            ->method('getMessages')
            ->willReturn(array('errors'));

        $this->inputFilterCreateMock->expects($this->never())
            ->method('getValues');

        $this->assertNull($this->service->create($this->data));
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Cannot create entity form empty data
     */

    public function testCreate_EmptyData_ThrowException() {
        $this->inputFilterCreateMock->expects($this->once())
            ->method('setData')
            ->with($this->equalTo($this->data));

        $this->inputFilterCreateMock->expects($this->once())
            ->method('isValid')
            ->willReturn(true);

        $this->inputFilterCreateMock->expects($this->never())
            ->method('getMessages');

        $this->inputFilterCreateMock->expects($this->once())
            ->method('getValues')
            ->willReturn(array());

        $this->service->create($this->data);
    }

    public function testCreate_Normal_ReturnEmployee() {
        $page = new Page(array('id' => 1));


        $this->inputFilterCreateMock->expects($this->once())
            ->method('setData')
            ->with($this->equalTo($this->data));

        $this->inputFilterCreateMock->expects($this->once())
            ->method('isValid')
            ->willReturn(true);

        $this->inputFilterCreateMock->expects($this->never())
            ->method('getMessages');

        $this->inputFilterCreateMock->expects($this->once())
            ->method('getValues')
            ->willReturn($this->data);

        $this->entityFactoryMock->expects($this->once())
            ->method('create')
            ->willReturn($page);

        $this->dbRepositoryMock->expects($this->once())
            ->method('add')
            ->with($this->equalTo($page));

        $this->eventManagerMock->expects($this->once())
            ->method('trigger')
            ->with($this->equalTo('create:post'),
                $this->equalTo($this->service),
                $this->equalTo(array('entity' => $page))
            );

        $result = $this->service->create($this->data);

        $this->assertSame($page, $result);
    }

}