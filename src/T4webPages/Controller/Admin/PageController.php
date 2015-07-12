<?php

namespace T4webPages\Controller\Admin;

use T4webActionInjections\Mvc\Controller\AbstractActionController;
use T4webPages\Page\Service\Create as ServiceCreate;

class PageController extends AbstractActionController {

    public function newAction(PageViewModel $view)
    {
        return $view;
    }

    public function createAction(PageViewModel $view, array $params, ServiceCreate $createService)
    {
        $page = $createService->create($params);
die(var_dump($page, $createService->getErrors()));
        if (!$page) {
            $view->setFormData($params);
            $view->setErrors($createService->getErrors());
            return $view;
        }

        $params['employeeId'] = $page->getId();
        $view->setFormData($params);

        return $this->redirect()->toRoute('admin-pages-list');

    }

}
