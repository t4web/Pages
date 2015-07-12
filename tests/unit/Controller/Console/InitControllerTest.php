<?php

namespace T4webPagesTest\Unit\Controller\Console;

use T4webPages\Controller\Console\InitController;
use Zend\Db\Adapter\Adapter;

class InitControllerTest extends \PHPUnit_Framework_TestCase
{
    private $controller;
    private $dbAdapterMock;

    public function setUp() {
        $this->dbAdapterMock = $this->getMockBuilder('Zend\Db\Adapter\Adapter')
            ->disableOriginalConstructor()
            ->getMock();

        $this->controller = new InitController($this->dbAdapterMock);
    }

    public function testRunAction() {

        $platformMock = $this->getMockBuilder('Zend\Db\Adapter\Platform\Mysql')
            ->disableOriginalConstructor()
            ->getMock();

        $this->dbAdapterMock->expects($this->any())
            ->method('getPlatform')
            ->willReturn($platformMock);

        $this->dbAdapterMock->expects($this->once())
            ->method('query')
            ->with($this->stringContains('CREATE TABLE'), $this->equalTo(Adapter::QUERY_MODE_EXECUTE))
            ->willReturn(true);

        $result = $this->controller->runAction();

        $this->assertEquals("Success completed" . PHP_EOL, $result);
    }

}