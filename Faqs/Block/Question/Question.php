<?php
declare(strict_types=1);

namespace Bss\Faqs\Block\Question;

use Bss\Faqs\Model\CategoryFaqRepository;
use Bss\Faqs\Model\FaqRepository;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Block Category
 *
 * Class Category
 */
class Question extends \Magento\Framework\View\Element\Template
{
    protected $categoryFaqRepository;
    /**
     * @var FaqRepository
     */
    protected $faqRepository;
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Construct
     *
     * @param FaqRepository $faqRepository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        CategoryFaqRepository $categoryFaqRepository,
        FaqRepository $faqRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        Context $context,
        array $data = []
    ) {
        $this->categoryFaqRepository = $categoryFaqRepository;
        $this->faqRepository = $faqRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context, $data);
    }

    /**
     * Function get all data Category
     *
     * @return array[]
     */
    public function getFaqCategoriesList(): array
    {
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
        $searchFaq = $this->searchCriteriaBuilder->create();
        return $this->faqRepository->getList($searchFaq)->getItems();
    }

    public function getFileBaseUrl($path)
    {
        return $this->storeManager->getStore()->getBaseUrl(
            UrlInterface::URL_TYPE_MEDIA
        ) . 'faqs/image/' .$path;
    }
}
