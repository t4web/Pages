<?php

namespace T4webPages\Controller\Admin;

use T4webActionInjections\Mvc\Controller\AbstractActionController;
use T4webPages\Page\Service\Create as ServiceCreate;
use Zend\Mvc\Controller\Plugin\Redirect;

class PageController extends AbstractActionController {

    public function newAction(PageViewModel $view)
    {
        return $view;
    }

    public function createAction(
        PageViewModel $view, array $params, ServiceCreate $createService, Redirect $redirect)
    {
        $page = $createService->create($params);

        if (!$page) {
            $view->setFormData($params);
            $view->setErrors($createService->getErrors());
            return $view;
        }

        return $redirect->toRoute('admin-pages-list');
    }

}
