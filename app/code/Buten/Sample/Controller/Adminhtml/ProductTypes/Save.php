<?php

namespace Buten\Sample\Controller\Adminhtml\ProductTypes;

use Buten\Sample\Api\Data\ProductTypesInterface;
use Buten\Sample\Api\ProductTypesRepositoryInterface;
use Buten\Sample\Model\ProductTypesFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\InventoryApi\Api\Data\SourceInterface;


class Save extends Action implements HttpPostActionInterface
{
    private ProductTypesRepositoryInterface $productTypesRepository;
    private ProductTypesFactory $productTypesFactory;

    public function __construct(
        Context $context,
        ProductTypesRepositoryInterface $productTypesRepository,
        ProductTypesFactory $productTypesFactory
    ) {
        parent::__construct($context);
        $this->productTypesRepository = $productTypesRepository;
        $this->productTypesFactory = $productTypesFactory;
    }

    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $request = $this->getRequest();
        $requestData = $request->getPost()->toArray();

        if (!$request->isPost() || empty($requestData['general'])) {
            $this->messageManager->addErrorMessage(__('Wrong request.'));
            $resultRedirect->setPath('*/*/new');
            return $resultRedirect;
        }

        try {
            $id = $requestData['general'][ProductTypesInterface::ID];
            $productType = $this->productTypesRepository->get($id);
        } catch (\Exception $e) {
            $productType = $this->productTypesFactory->create();
        }

        $productType->setType($requestData['general'][ProductTypesInterface::TYPE]);
        try {
            $productType = $this->productTypesRepository->save($productType);
            $this->processRedirectAfterSuccessSave($resultRedirect, $productType->getId());
            $this->messageManager->addSuccessMessage(__('Product type was saved.'));

        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('Error. Cannot save'));

            $resultRedirect->setPath('*/*/new');
        }

        return $resultRedirect;
    }

    private function processRedirectAfterSuccessSave(Redirect $resultRedirect, string $id)
    {
        if ($this->getRequest()->getParam('back')) {
            $resultRedirect->setPath(
                '*/*/types',
                [
                    ProductTypesInterface::ID => $id,
                    '_current' => true,
                ]
            );
        } elseif ($this->getRequest()->getParam('redirect_to_new')) {
            $resultRedirect->setPath(
                '*/*/new',
                [
                    '_current' => true,
                ]
            );
        } else {
            $resultRedirect->setPath('*/*/types');
        }
    }
}
