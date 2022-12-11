<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bss\Faqs\Model\Faq\Options;

use Bss\Faqs\Model\ResourceModel\CategoryFaq\CollectionFactory;

/**
 * Attribute Set Options
 */
class CategorySelect implements \Magento\Framework\Data\OptionSourceInterface
{

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray(): array
    {

        $collection = $this->collectionFactory->create();
        $result = [['label' => '', 'value' => '']];
        foreach ($collection as $category) {
            if($category->getStatus()){
                $result[] = [
                    'value' => $category->getId(),
                    'label' => __('%1', $category->getName()),
                ];
            }
        }

        return $result;
    }

}
