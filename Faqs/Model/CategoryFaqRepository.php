<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Bss\Faqs\Model;

use Bss\Faqs\Api\CategoryFaqRepositoryInterface;
use Bss\Faqs\Api\Data\CategoryFaqInterface;
use Bss\Faqs\Api\Data\CategoryFaqInterfaceFactory;
use Bss\Faqs\Api\Data\CategoryFaqSearchResultsInterfaceFactory;
use Bss\Faqs\Model\ResourceModel\CategoryFaq as ResourceCategoryFaq;
use Bss\Faqs\Model\ResourceModel\CategoryFaq\CollectionFactory as CategoryFaqCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class CategoryFaqRepository implements CategoryFaqRepositoryInterface
{

    /**
     * @var CategoryFaqInterfaceFactory
     */
    protected $categoryFaqFactory;

    /**
     * @var CategoryFaq
     */
    protected $searchResultsFactory;

    /**
     * @var CategoryFaqCollectionFactory
     */
    protected $categoryFaqCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var ResourceCategoryFaq
     */
    protected $resource;


    /**
     * @param ResourceCategoryFaq $resource
     * @param CategoryFaqInterfaceFactory $categoryFaqFactory
     * @param CategoryFaqCollectionFactory $categoryFaqCollectionFactory
     * @param CategoryFaqSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceCategoryFaq $resource,
        CategoryFaqInterfaceFactory $categoryFaqFactory,
        CategoryFaqCollectionFactory $categoryFaqCollectionFactory,
        CategoryFaqSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->categoryFaqFactory = $categoryFaqFactory;
        $this->categoryFaqCollectionFactory = $categoryFaqCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(CategoryFaqInterface $categoryFaq)
    {
        try {
            $this->resource->save($categoryFaq);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the categoryFaq: %1',
                $exception->getMessage()
            ));
        }
        return $categoryFaq;
    }

    /**
     * @inheritDoc
     */
    public function get($categoryFaqId)
    {
        $categoryFaq = $this->categoryFaqFactory->create();
        $this->resource->load($categoryFaq, $categoryFaqId);
        if (!$categoryFaq->getId()) {
            throw new NoSuchEntityException(__('CategoryFaq with id "%1" does not exist.', $categoryFaqId));
        }
        return $categoryFaq;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->categoryFaqCollectionFactory->create();

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(CategoryFaqInterface $categoryFaq)
    {
        try {
            $categoryFaqModel = $this->categoryFaqFactory->create();
            $this->resource->load($categoryFaqModel, $categoryFaq->getId());
            $this->resource->delete($categoryFaqModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the CategoryFaq: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($id)
    {
        return $this->delete($this->get($id));
    }
}

