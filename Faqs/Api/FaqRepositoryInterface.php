<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Bss\Faqs\Api;

use Bss\Faqs\Api\Data\FaqInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface FaqRepositoryInterface
{
    /**
     * Retrieve  Test
     *
     * @param string $id
     * @return mixed
     */
    public function get($id);

    /**
     * Retrieve Faq matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return FaqInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete Faq
     *
     * @param FaqInterface $faq
     * @return bool true on success
     */
    public function delete(FaqInterface $faq);

    /**
     * Save Faq
     *
     * @param FaqInterface $faq
     * @return FaqInterface
     */
    public function save(FaqInterface $faq);

    /**
     * Delet Faq by ID
     *
     * @param string $id
     * @return bool true on success
     */
    public function deleteById($id);
}
