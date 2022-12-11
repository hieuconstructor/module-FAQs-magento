<?php
declare(strict_types=1);

namespace Bss\Faqs\Block\Faq;

use Bss\Faqs\Model\CategoryFaqRepository;
use Bss\Faqs\Model\FaqRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Block Category
 *
 * Class Category
 */
class Faq extends \Magento\Framework\View\Element\Template
{
    protected $categoryFaqRepository;
    /**
     * @var FaqRepository
     */
    protected $faqRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

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
        SearchCriteriaBuilder $searchCriteriaBuilder,
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
    public function getFaqCategoriesList(): array
    {
        $this->searchCriteriaBuilder->addFilter('status', 1);
        $searchCategories = $this->searchCriteriaBuilder->create();
        return $this->categoryFaqRepository->getList($searchCategories)->getItems();
    }

    /**
     * Function get all data faq
     *
     * @return array[]
     */
    public function getFaqsList(): array
    {
        $this->searchCriteriaBuilder->addFilter('status', 1);
        return $this->faqRepository->getList($this->searchCriteriaBuilder->create())->getItems();
    }

    public function getFileBaseUrl($path)
    {
        return $this->storeManager->getStore()->getBaseUrl(
            UrlInterface::URL_TYPE_MEDIA
        ) . 'faqs/image/' .$path;
    }


}
