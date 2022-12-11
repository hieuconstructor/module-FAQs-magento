<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Bss\Faqs\Api\Data;

interface FaqSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Test list.
     *
     * @return \Bss\Faqs\Api\Data\FaqInterface[]
     */
    public function getItems();

    /**
     * Set title list.
     *
     * @param \Bss\Faqs\Api\Data\FaqInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

