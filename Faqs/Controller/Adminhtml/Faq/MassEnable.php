<?php
declare(strict_types=1);

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Bss\Faqs\Controller\Adminhtml\Faq;

use Bss\Faqs\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Result\PageFactory;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Massaction delete
 *
 */
class MassEnable extends Action implements HttpPostActionInterface
{
    /**
     * @var PageFactory
     */
    protected PageFactory $resultPageFactory;
    /**
     * @var CollectionFactory
     */
    protected CollectionFactory $faqFactory;
    /**
     * @var Filter
     */
    protected Filter $filter;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Filter $filter
     * @param CollectionFactory $faq
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Filter $filter,
        CollectionFactory $faq
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->faqFactory = $faq;
        $this->filter = $filter;
        parent::__construct($context);
    }

    /**
     * Execute
     *
     * @return ResultInterface
     * @throws LocalizedException
     */
    public function execute(): ResultInterface
    {

        $collection = $this->filter->getCollection($this->faqFactory->create());

        $count = 0;
        foreach ($collection as $child) {
            $child->setStatus(true);
            $child->save();
            $count++;
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been enable.', $count));
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/');
    }

}
