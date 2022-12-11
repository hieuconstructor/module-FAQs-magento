<?php

namespace Bss\Faqs\Controller\Adminhtml\CategoryFaq;

use Bss\Faqs\Api\Data\CategoryFaqInterface;
use Bss\Faqs\Model\CategoryFaqRepository;
use Magento\Backend\App\Action;

use Magento\Framework\App\Request\DataPersistorInterface;
use Bss\Faqs\Model\ImageUploader;
use Symplify\RuleDocGenerator\Contract\Category\CategoryInfererInterface;

/**
 * This is
 *
 * Class Save
 */
class Save extends Action
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Bss_Faqs::CategoryFaq_save';

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var ImageUploader
     */
    protected $imageUploader;

    protected $categoryFaqRepository;
    protected $categoryInterface;
    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(

        CategoryFaqRepository $categoryFaqRepository,
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        CategoryFaqInterface $categoryInterface,
        ImageUploader $imageUploader,
    ) {
        $this->categoryFaqRepository = $categoryFaqRepository;
        $this->categoryInterface = $categoryInterface;
        $this->dataPersistor = $dataPersistor;
        $this->imageUploader = $imageUploader;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            // Optimize data

            if (empty($data['id'])) {
                $data['id'] = null;
            }
            $imageName = '';
            if (empty($data['image'])) {
                $data['image'] = null;
            } else {
                if ($data['image'][0] && $data['image'][0]['name']) {
                    $data['image'] = $data['image'][0]['name'];
                    $imageName = $data['image'];
                } else {
                    $data['image'] = null;
                }
            }

            // Init model and load by ID if exists
            $model = $this->categoryInterface;
            $imageName2 = null;
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model = $this->categoryFaqRepository->get($id);
                $imageName2 = $model->getImage();
            }
             // Update model
            $model->setData($data);

            // Save data to database
            try {
                $this->categoryFaqRepository->save($model);
                if ($imageName!=$imageName2) {
                    $this->imageUploader->moveFileFromTmp($imageName);
                }
                $this->messageManager->addSuccessMessage(__('You saved the category.'));
                $this->dataPersistor->clear('faq_cat');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['
                    id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the category.'));
            }

            $this->dataPersistor->set('faq_cat', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }

        // Redirect to List page
        return $resultRedirect->setPath('*/*/');
    }
}
