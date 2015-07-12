<?php

namespace T4webPagesTest\Unit\Controller\Admin;

use T4webPages\Controller\Admin\PageController;
use T4webPages\Controller\Admin\PageViewModel;

class PageControllerTest extends \PHPUnit_Framework_TestCase
{
    private $controller;
    private $pageViewModel;

    public function setUp() {
        $this->pageViewModel = new PageViewModel();

        $this->controller = new PageController();
    }

    public function testNewAction() {
        /** @var $result PageViewModel */
        $result = $this->controller->newAction($this->pageViewModel);

        $this->assertEquals($this->pageViewModel, $result);
    }

    public function testSuccessCreateAction() {

        $createServiceMock = $this->getMockBuilder('T4webPages\Page\Service\Create')
            ->disableOriginalConstructor()
            ->getMock();

        $params = ['param' => 'value'];

        $redirectMock = $this->getMockBuilder('Zend\Mvc\Controller\Plugin\Redirect')
            ->disableOriginalConstructor()
            ->getMock();

        $createServiceMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo($params))
            ->willReturn(true);

        $redirectMock->expects($this->once())
            ->method('toRoute')
            ->with($this->equalTo('admin-pages-list'));

        /** @var $result PageViewModel */
        $result = $this->controller->createAction($this->pageViewModel, $params, $createServiceMock, $redirectMock);

        $this->assertNull($result);
    }

    public function testErrorCreateAction() {

        $createServiceMock = $this->getMockBuilder('T4webPages\Page\Service\Create')
            ->disableOriginalConstructor()
            ->getMock();

        $params = ['param' => 'value'];

        $redirectMock = $this->getMockBuilder('Zend\Mvc\Controller\Plugin\Redirect')
            ->disableOriginalConstructor()
            ->getMock();

        $inputErrorMock = $this->getMockBuilder('T4webBase\InputFilter\InvalidInputError')
            ->disableOriginalConstructor()
            ->getMock();

        $createServiceMock->expects($this->once())
            ->method('create')
            ->with($this->equalTo($params))
            ->willReturn(false);

        $createServiceMock->expects($this->once())
            ->method('getErrors')
            ->willReturn($inputErrorMock);

        $redirectMock->expects($this->never())
            ->method('toRoute');

        /** @var $result PageViewModel */
        $result = $this->controller->createAction($this->pageViewModel, $params, $createServiceMock, $redirectMock);

        $this->assertEquals($this->pageViewModel, $result);
    }
}