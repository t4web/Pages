<?php
namespace T4webPages\Page\Service;

use Zend\EventManager\EventManager;
use T4webBase\InputFilter\InputFilterInterface;
use T4webBase\Domain\Repository\DbRepository;
use T4webBase\Domain\Factory\EntityFactoryInterface;
use T4webBase\Domain\Service\Create as BaseCreate;
use T4webPages\Page\Page;

class Create extends BaseCreate {

    public function __construct(
        InputFilterInterface $inputFilter,
        DbRepository $repository,
        EntityFactoryInterface $entityFactory,
        EventManager $eventManager = null) {

        $this->inputFilter = $inputFilter;
        $this->repository = $repository;
        $this->entityFactory = $entityFactory;
        $this->eventManager = $eventManager;
    }

    /**
     * @param array $data
     * @return null|Page
     */
    public function create(array $data) {

        if (!$this->isValid($data)) {
            return;
        }

        $data = $this->inputFilter->getValues();

        if (empty($data)) {
            throw new \RuntimeException("Cannot create entity form empty data");
        }

        $data['dtCreated'] = date('Y-m-d H:i:s');

        /** @var Page $page */
        $page = $this->entityFactory->create($data);
        $this->repository->add($page);

        $data['pageId'] = $page->getId();

        $this->trigger($page);

        return $page;
    }

}