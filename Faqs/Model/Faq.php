<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);


namespace Bss\Faqs\Model;

use Bss\Faqs\Api\Data\FaqInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Faq
 */
class Faq extends AbstractModel implements FaqInterface
{
    /**
     * Init CategoryFaq
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(\Bss\Faqs\Model\ResourceModel\Faq::class);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheritDoc
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * @inheritDoc
     */
    public function getViewed()
    {
        return $this->getData(self::VIEWED);
    }

    /**
     * @inheritDoc
     */
    public function setViewed($viewed)
    {
        return $this->getData(self::VIEWED, $viewed);
    }

    /**
     * @inheritDoc
     */
    public function getLiked()
    {
        return $this->getData(self::LIKED);
    }

    /**
     * @inheritDoc
     */
    public function setLiked($liked)
    {
        return $this->getData(self::LIKED, $liked);
    }
    /**
     * @inheritDoc
     */
    public function getDisliked()
    {
        return $this->getData(self::DISLIKED);
    }
    /**
     * @inheritDoc
     */
    public function setDisliked($disliked)
    {
        return $this->getData(self::DISLIKED, $disliked);
    }
    /**
     * @inheritDoc
     */
    public function getCreateBy()
    {
        return $this->getData(self::CREATED_BY);
    }
    /**
     * @inheritDoc
     */
    public function setCreateBy($createBy)
    {
        return $this->getData(self::CREATED_BY, $createBy);
    }
    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }
    /**
     * @inheritDoc
     */
    public function setCreatedAt($createdAt)
    {
        return $this->getData(self::CREATED_AT, $createdAt);
    }
    /**
     * @inheritDoc
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }
    /**
     * @inheritDoc
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->getData(self::UPDATED_AT, $updatedAt);
    }
    /**
     * @inheritDoc
     */
    public function getCategoryId()
    {
        return $this->getData(self::CATEGORY_ID);
    }
    /**
     * @inheritDoc
     */
    public function setCategoryId($categoryId)
    {
        return $this->getData(self::CATEGORY_ID, $categoryId);
    }
}
