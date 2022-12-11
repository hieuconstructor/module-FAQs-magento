<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bss\Faqs\Model\CategoryFaq\Options;

/**
 * Attribute Set Options
 */
class Status implements \Magento\Framework\Data\OptionSourceInterface
{

    public function toOptionArray()
    {
        $result = [];
        foreach ($this->getOptions() as $value => $label) {
            $result[] = [
                 'value' => $value,
                 'label' => $label,
             ];
        }

        return $result;
    }

    public function getOptions()
    {
        return [
            '1' => __('Active'),
            '0' => __('Inactive'),

        ];
    }
}
