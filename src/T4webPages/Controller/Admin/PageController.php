<?php

namespace T4webPages\Controller\Admin;

use Zend\Mvc\Controller\AbstractActionController;

class PageController extends AbstractActionController {

    public function createAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->flashMessenger()->addMessage('Bad request', 'general');
            return $this->view;
        }

        $params = $this->getRequest()->getPost()->toArray();

        $employee = $this->createService->create($params);

        if (!$employee) {
            $this->view->setFormData($params);
            $this->view->setErrors($this->createService->getErrors());
            $this->flashMessenger()->addMessage('You are now logged in.');
            return $this->view;
        }

        $params['employeeId'] = $employee->getId();
        $this->view->setFormData($params);

        return $this->redirect()->toRoute('admin-permissions-roles-list');
    }

}
