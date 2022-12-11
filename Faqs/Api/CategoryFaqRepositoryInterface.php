<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Bss\Faqs\Api;

use Bss\Faqs\Api\Data\CategoryFaqInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface CategoryFaqRepositoryInterface
{
    /**
     * Retrieve CategoryTest
     *
     * @param string $id
     * @return mixed
     */
    public function get($id);

    /**
     * Retrieve CategoryFaq matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return CategoryFaqInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete CategoryTest
     *
     * @param CategoryFaqInterface $categoryFaq
     * @return bool true on success
     */
    public function delete(CategoryFaqInterface $categoryFaq);

    /**
     * Save CategoryTest
     *
     * @param CategoryFaqInterface $categoryFaq
     * @return CategoryFaqInterface
     */
    public function save(CategoryFaqInterface $categoryFaq);

    /**
     * Delete CategoryTest by ID
     *
     * @param string $id
     * @return bool true on success
     */
    public function deleteById($id);
}
