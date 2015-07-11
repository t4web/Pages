<?php

namespace T4webPages\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;

class PagesController extends AbstractActionController {

    /**
     * @return ViewModel
     */
    public function listAction()
    {
        return $this->view;
    }

}
