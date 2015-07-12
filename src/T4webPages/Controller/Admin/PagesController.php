<?php

namespace T4webPages\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;

class PagesController extends AbstractActionController {

    /**
     * @return ListViewModel
     */
    public function listAction($view)
    {
        return $view;
    }

}
