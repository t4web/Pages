<?php

namespace T4webPages\Controller\Admin;

use Zend\View\Model\ViewModel;
use T4webBase\Domain\Collection;

class ListViewModel extends ViewModel
{

    /**
     * @var Collection
     */
    private $pages;

    /**
     * @return Collection
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param Collection $pages
     */
    public function setPages(Collection $pages)
    {
        $this->pages = $pages;
    }

}
