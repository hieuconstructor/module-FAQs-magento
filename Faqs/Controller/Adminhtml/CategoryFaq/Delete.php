<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Bss\Faqs\Controller\Adminhtml\CategoryFaq;

use Bss\Faqs\Model\CategoryFaqRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect as RedirectAlias;

/**
 * Delete Category Faq
 *
 * Class Delete
 */
class Delete extends Action
{
    /**
     * @var CategoryFaqRepository
     */
    protected $categoryFaqRepository;

    /**
     * @param Context $context
     * @param CategoryFaqRepository $categoryFaqRepository
     */
    public function __construct(
        Context $context,
        CategoryFaqRepository $categoryFaqRepository,
    ) {
        $this->categoryFaqRepository = $categoryFaqRepository;
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

            $this->categoryFaqRepository->deleteById($id);

            $this->messageManager->addSuccessMessage(__('You deleted the category.'));
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
        return $this->_authorization->isAllowed('Bss_Faqs::CategoryFaq_delete');
    }
}

