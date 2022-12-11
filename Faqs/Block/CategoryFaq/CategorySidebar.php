<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Bss\Faqs\Block\CategoryFaq;

use Bss\Faqs\Model\CategoryFaqRepository;
use Bss\Faqs\Model\FaqRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;

/**
 *
 */
class CategorySidebar extends \Magento\Framework\View\Element\Template
{
    /**
     * @var CategoryFaqRepository
     */
    protected $categoryFaqRepository;

    /**
     * @var FaqRepository
     */
    protected $faqRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    protected $storeManager;

    /**
     * Constructor
     *
     * @param CategoryFaqRepository $categoryFaqRepository
     * @param FaqRepository $faqRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        CategoryFaqRepository $categoryFaqRepository,
        FaqRepository         $faqRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        StoreManagerInterface $storeManager,
        Context               $context,
        array                 $data = []
    ) {
        $this->faqRepository = $faqRepository;
        $this->categoryFaqRepository = $categoryFaqRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
    }

    /**
     * Function get all data Category
     *
     * @return array[]
     */
    public function getFaqCategoriesList(): array
    {
        $this->searchCriteriaBuilder->addFilter('status', 1);
        return $this->categoryFaqRepository->getList($this->searchCriteriaBuilder->create())->getItems();
    }

    /**
     * Function get all data faq
     *
     * @return array[]
     */
    public function getFaqsList(): array
    {
        $this->searchCriteriaBuilder->addFilter('status', 1);
        $searchFaq = $this->searchCriteriaBuilder->create();
        return $this->faqRepository->getList($searchFaq)->getItems();
    }

    /**
     * Count
     *
     * @param $cateId
     * @return int|null
     */
    public function count($cateId)
    {
        $id = (int)$cateId;
        $this->searchCriteriaBuilder->addFilter('status', 1);
        $this->searchCriteriaBuilder->addFilter('category_id', $id);
        $searchFaq = $this->searchCriteriaBuilder->create();
        $count = $this->faqRepository->getList($searchFaq)->getItems();
        return sizeof($count);
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getUrlCate($id): string
    {
        return $this->storeManager->getStore()->getBaseUrl().'faqs/category/view/id/'.$id;
    }

}
