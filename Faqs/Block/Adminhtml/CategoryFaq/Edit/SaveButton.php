<?php
namespace Bss\Faqs\Block\Adminhtml\CategoryFaq\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveButton
 */
class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save Category'),
            'class' => 'save primary',
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'sort_order' => 90,
        ];
    }

    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/save');
    }
}
