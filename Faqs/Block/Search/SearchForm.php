<?php
declare(strict_types=1);

namespace Bss\Faqs\Block\Search;

class SearchForm extends \Magento\Framework\View\Element\Template
{
    /**
     * Returns action url for search form
     *
     * @return string
     */
    public function getFormAction()
    {
        return $this->_storeManager->getStore()->getUrl('faqs/search/', [
            '_secure' => $this->_storeManager->getStore()->isCurrentlySecure()]);
    }

    /**
     * Get Text search from url
     *
     * @return string
     */
    public function getTextSearch(): string
    {
        return ($this->getRequest()->getParam('s')) ? $this->escapeHtml($this->getRequest()->getParam('s')) : '';
    }
}
