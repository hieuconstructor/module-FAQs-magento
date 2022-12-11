<?php
declare(strict_types=1);

namespace Bss\Faqs\Block\CategoryFaq;

use Bss\Faqs\Model\CategoryFaqRepository;
use Bss\Faqs\Model\FaqRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Block Category
 *
 * Class Category
 */
class Category extends \Magento\Framework\View\Element\Template
{
    protected CategoryFaqRepository $categoryFaqRepository;
    /**
     * @var FaqRepository
     */
    protected FaqRepository $faqRepository;
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected SearchCriteriaBuilder $searchCriteriaBuilder;
    protected UrlInterface $urlBuilder;
    /**
     * Construct
     *
     * @param CategoryFaqRepository $categoryFaqRepository
     * @param FaqRepository $faqRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param StoreManagerInterface $storeManager
     * @param UrlInterface $urlBuilder
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        CategoryFaqRepository $categoryFaqRepository,
        FaqRepository $faqRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        StoreManagerInterface $storeManager,
        UrlInterface $urlBuilder,
        Context $context,
        array $data = []
    ) {
        $this->categoryFaqRepository = $categoryFaqRepository;
        $this->faqRepository = $faqRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->storeManager = $storeManager;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $data);
    }

    /**
     * Function get all data Category
     *
     * @return array[]
     */
    public function getFaqCategoriesList()
    {
        $this->searchCriteriaBuilder->addFilter('status', 1);
        $searchCategories = $this->searchCriteriaBuilder->create();
        $categories = $this->categoryFaqRepository->getList($searchCategories)->getItems();
        return $categories;
    }

    /**
     * Function get all data faq
     *
     * @return array[]
     */
    public function getFaqsList(): array
    {
        $this->searchCriteriaBuilder->addFilter('status', 1);
        $this->searchCriteriaBuilder->addFilter('category_id', $this->getCateID());
        return $this->faqRepository->getList($this->searchCriteriaBuilder->create())->getItems();
    }
    public function getFileBaseUrl($path): string
    {
        return $this->storeManager->getStore()->getBaseUrl(
            UrlInterface::URL_TYPE_MEDIA
        ) . 'faqs/image/' .$path;
    }

    public function getCateID()
    {
        return $this->getRequest()->getParam('id');
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getNameCate()
    {
        return $this->categoryFaqRepository->get($this->getCateID())->getName();
    }
}
