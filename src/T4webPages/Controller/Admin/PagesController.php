<?php

namespace T4webPages\Controller\Admin;

use T4webActionInjections\Mvc\Controller\AbstractActionController;
use T4webBase\Domain\Service\BaseFinder as FinderService;
use T4webBase\Domain\Collection;

class PagesController extends AbstractActionController {

    /**
     * @return ListViewModel
     */
    public function listAction(ListViewModel $view, FinderService$finder)
    {
        /** @var $pages Collection */
        $pages = $finder->findMany();

        $view->setPages($pages);
        return $view;
    }

}
