<?php

namespace T4webPagesTest\Unit\Controller\Admin;

use T4webPages\Controller\Admin\PageViewModel;

class PageViewModelTest extends \PHPUnit_Framework_TestCase
{
    private $viewModel;

    public function setUp() {
        $this->viewModel = new PageViewModel();
    }

    public function testSetErrors() {
        $inputErrorMock = $this->getMockBuilder('T4webBase\InputFilter\InvalidInputError')
            ->disableOriginalConstructor()
            ->getMock();

        $someErrors = ['field' => 'value'];

        $inputErrorMock->expects($this->once())
            ->method('getErrors')
            ->willReturn($someErrors);

        $this->viewModel->setErrors($inputErrorMock);

        $this->assertAttributeEquals($someErrors, 'errors', $this->viewModel);
    }

    public function testGetErrors() {

        $inputErrorMock = $this->getMockBuilder('T4webBase\InputFilter\InvalidInputError')
            ->disableOriginalConstructor()
            ->getMock();

        $someErrors = ['field' => 'value'];

        $inputErrorMock->expects($this->once())
            ->method('getErrors')
            ->willReturn($someErrors);

        $this->viewModel->setErrors($inputErrorMock);

        $this->assertEquals($someErrors, $this->viewModel->getErrors());
        $this->assertEquals($someErrors['field'], $this->viewModel->getErrors('field'));
    }

    public function testGetHasErrorClass() {

        $inputErrorMock = $this->getMockBuilder('T4webBase\InputFilter\InvalidInputError')
            ->disableOriginalConstructor()
            ->getMock();

        $someErrors = ['field' => 'value'];

        $inputErrorMock->expects($this->once())
            ->method('getErrors')
            ->willReturn($someErrors);

        $this->viewModel->setErrors($inputErrorMock);

        $this->assertEquals('has-error', $this->viewModel->getHasErrorClass('field'));
        $this->assertEquals('', $this->viewModel->getHasErrorClass('other field'));
    }

    public function testSetFormData() {
        $data = ['field' => 'value'];

        $this->viewModel->setFormData($data);

        $this->assertAttributeEquals($data, 'formData', $this->viewModel);
    }

    public function testGetFormData() {

        $data = ['field' => 'value'];

        $this->viewModel->setFormData($data);

        $this->assertEquals($data, $this->viewModel->getFormData());
        $this->assertEquals($data['field'], $this->viewModel->getFormData('field'));
        $this->assertEquals('', $this->viewModel->getFormData('other field'));
    }
}