<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Bss\Faqs\Controller\Adminhtml\Faq;

use Bss\Faqs\Model\FaqRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect as RedirectAlias;

/**
 * Delete Faq
 *
 * Class Delete
 */
class Delete extends Action
{
    /**
     * @var FaqRepository
     */
    protected $faqRepository;

    /**
     * @param Context $context
     * @param FaqRepository $faqRepository
     */
    public function __construct(
        Context $context,
        FaqRepository $faqRepository,
    ) {
        $this->faqRepository = $faqRepository;
        parent::__construct($context);
    }

    /**
     * @return RedirectAlias|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var RedirectAlias $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('id');
        try {

            $this->faqRepository->deleteById($id);

            $this->messageManager->addSuccessMessage(__('You deleted the faq.'));
            return $resultRedirect->setPath('*/*/');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            // go back to edit form
            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * @return bool
     */
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bss_Faqs::Faq_delete');
    }
}

