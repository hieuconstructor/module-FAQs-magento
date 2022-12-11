<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Bss\Faqs\Api\Data;

interface CategoryFaqSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get CategoryTest list.
     * @return \Bss\Faqs\Api\Data\CategoryFaqInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Bss\Faqs\Api\Data\CategoryFaqInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

