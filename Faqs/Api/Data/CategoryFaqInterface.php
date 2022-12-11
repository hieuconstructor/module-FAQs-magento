<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Bss\Faqs\Api\Data;

/**
 * CATEGORYFAQ block interface.
 * @api
 * @since 100.0.2
 */
interface CategoryFaqInterface
{
    const STATUS = 'status';
    const ID = 'id';
    const NAME = 'name';
    const UPDATED_AT = 'updated_at';
    const CREATED_BY = 'created_by';
    const CREATED_AT = 'created_at';
    const IMAGE = 'image';

    /**
     * Get categoryFaq_id
     *
     * @return string|null
     */
    public function getId();

    /**
     * Set categoryFaq_id
     *
     * @param string $id
     * @return \Bss\Faqs\Api\CategoryFaq\Data\CategoryFaqInterface
     */
    public function setId($id);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     *
     * @param string $name
     * @return \Bss\Faqs\Api\CategoryFaq\Data\CategoryFaqInterface
     */
    public function setName($name);

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus();

    /**
     * Set status
     *
     * @param string $status
     * @return \Bss\Faqs\Api\CategoryFaq\Data\CategoryFaqInterface
     */
    public function setStatus($status);

    /**
     * Get image
     *
     * @return string|null
     */
    public function getImage();

    /**
     * Set image
     *
     * @param string $image
     * @return \Bss\Faqs\Api\CategoryFaq\Data\CategoryFaqInterface
     */
    public function setImage($image);

    /**
     * Get created_at
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     *
     * @param string $createdAt
     * @return \Bss\Faqs\Api\CategoryFaq\Data\CategoryFaqInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     *
     * @param string|null
     * @return \Bss\Faqs\Api\CategoryFaq\Data\CategoryFaqInterface
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Get created_by
     *
     * @return string|null
     */
    public function getCreatedBy();

    /**
     * Set created_by
     *
     * @param string $createdBy
     * @return \Bss\Faqs\Api\CategoryFaq\Data\CategoryFaqInterface
     */
    public function setCreatedBy($createdBy);
}

