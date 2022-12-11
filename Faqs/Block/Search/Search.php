<?php
declare(strict_types=1);

namespace  Bss\Faqs\Block\Search;

use Bss\Faqs\Model\FaqRepository;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template\Context;

/**
 *
 */
class Search extends \Magento\Framework\View\Element\Template
{
    /**
     * @var FaqRepository
     */
    protected $faqRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    protected SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * @var FilterBuilder
     */
    protected FilterBuilder $filterBuilder;
    /**
     * @var FilterGroupBuilder
     */
    protected FilterGroupBuilder $filterGroupBuilder;

    /**
     * @param FaqRepository $faqRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param FilterBuilder $filterBuilder
     * @param FilterGroupBuilder $filterGroupBuilder
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        FaqRepository $faqRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        FilterGroupBuilder $filterGroupBuilder,
        Context $context,
        array $data = []
    ) {
        $this->faqRepository = $faqRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->filterGroupBuilder = $filterGroupBuilder;
        parent::__construct($context, $data);
    }

    /**
     * Get Text search from url
     *
     * @return string
     */
    public function getTextSearch(): string
    {
        return ($this->getRequest()->getParam('s')) ? $this->escapeHtml($this->getRequest()->getParam('s')) : '';
    }

    /**
     * Function get all data faq search
     *
     * @return array[]
     */
    public function getFaqsList(): array
    {
        $this->searchCriteriaBuilder->addFilter('status', 1);
        $content = $this->filterBuilder->setField('content')
                        ->setValue("%".$this->getTextSearch()."%")
                        ->setConditionType('like')
                        ->create();
        $title = $this->filterBuilder->setField('title')
            ->setValue('%' .$this->getTextSearch(). '%')
            ->setConditionType('like')
            ->create();
        $filterOr1 = $this->filterGroupBuilder
            ->addFilter($content)
            ->addFilter($title)
            ->create();
        $this->searchCriteriaBuilder->setFilterGroups([$filterOr1]);
        return $this->faqRepository->getList($this->searchCriteriaBuilder->create())->getItems();
    }
}
