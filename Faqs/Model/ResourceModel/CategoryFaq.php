<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bss\Faqs\Model\ResourceModel;

/**
 * This is class init table faq_cat
 *
 * Class CategoryFaq
 */
class CategoryFaq extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Thi
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('faq_cat', 'id');
    }
}
