<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace  Bss\Faqs\Api\Data;

interface FaqInterface
{
    const ID = 'id';
    const TITLE = 'title';
    const VIEWED = 'viewed';
    const LIKED = 'liked';
    const DISLIKED = 'disliked';
    const CATEGORY_ID = 'category_id';
    const CREATED_BY = 'created_by';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * Get category id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set category id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get viewed
     *
     * @return int|null
     */
    public function getViewed();

    /**
     * Set viewed
     *
     * @param int $viewed
     * @return $this
     */
    public function setViewed($viewed);

    /**
     * Get category id
     *
     * @return int|null
     */
    public function getLiked();

    /**
     * Set category liked
     *
     * @param int $liked
     * @return $this
     */
    public function setLiked($liked);

    /**
     * Get category disliked
     *
     * @return int|null
     */
    public function getDisliked();

    /**
     * Set category disliked
     *
     * @param int $disliked
     * @return $this
     */
    public function setDisliked($disliked);

    /**
     * Get category create by
     *
     * @return string|null
     */
    public function getCreateBy();

    /**
     * Set create by
     *
     * @param string $createBy
     * @return $this
     */
    public function setCreateBy($createBy);

    /**
     * Get created at time
     *
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created at time
     *
     * @param string $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated at time
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated at time
     *
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Get Category ID
     *
     * @return string|null
     */
    public function getCategoryId();

    /**
     * Set category id
     *
     * @param string $categoryId
     * @return $this
     */
    public function setCategoryId($categoryId);
}
