<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Bss\Faqs\Controller\Adminhtml\Faq;

use Magento\Framework\Exception\LocalizedException;
use Bss\Faqs\Model\FaqRepository;
use Bss\Faqs\Api\Data\FaqInterface;

/**
 *
 */
class Save extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var FaqRepository
     */
    protected $faqRepository;
    /**
     * @var FaqInterface
     */
    protected $faqInterface;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context                   $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        FaqInterface                                          $faqInterface,
        FaqRepository                                         $faqRepository
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->faqInterface = $faqInterface;
        $this->faqRepository = $faqRepository;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (empty($data['id'])) {
                $data['id'] = null;
            }
            if (empty($data['title'])) {
                $data['title'] = null;
            }
            if (empty($data['content'])) {
                $data['content'] = null;
            }

            $model = $this->faqInterface;
            $model->setData($data);

            try {
                $this->faqRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the Faq.'));
                $this->dataPersistor->clear('faq');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Test.'));
            }

            $this->dataPersistor->set('faq', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
