<?php

namespace T4webPages\Controller\Admin;

use Zend\View\Model\ViewModel;
use T4webBase\InputFilter\InvalidInputError;

class PageViewModel extends ViewModel {

    protected $template = 't4web-pages/page/new.phtml';

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var array
     */
    protected $formData = [];

    /**
     * @param InvalidInputError $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors->getErrors();
    }

    /**
     * @param string|null $param
     *
     * @return array
     */
    public function getErrors($param = null)
    {
        if (empty($param)) {
            return $this->errors;
        }

        if (isset($this->errors[$param])) {
            return $this->errors[$param];
        }

        return [];
    }

    /**
     * @param string|null $param
     *
     * @return bool
     */
    public function getHasErrorClass($param = null)
    {
        return count($this->getErrors($param)) > 0 ? 'has-error' : '';
    }

    /**
     * @param array $formData
     */
    public function setFormData($formData)
    {
        $this->formData = $formData;
    }

    /**
     * @param string|null $param
     *
     * @return array|string
     */
    public function getFormData($param = null)
    {
        if (empty($param)) {
            return $this->formData;
        }

        if (isset($this->formData[$param])) {
            return $this->formData[$param];
        }

        return '';
    }

}
