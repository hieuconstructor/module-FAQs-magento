<?php
declare(strict_types=1);
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Bss\Faqs\Controller\Adminhtml\CategoryFaq;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * This is Edit
 *
 * Class Edit
 */
class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    public $resultPageFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $resultPage = $this->resultPageFactory->create();
        if ($id==null) {
            $resultPage->getConfig()->getTitle()->prepend(__("New Category"));
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__("Edit Category"));
        }

        return $resultPage;
    }
}
