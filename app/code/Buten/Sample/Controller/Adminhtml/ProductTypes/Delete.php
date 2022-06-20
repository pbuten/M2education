<?php


namespace Buten\Sample\Controller\Adminhtml\ProductTypes;


use Buten\Sample\Api\ProductTypesRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Delete extends Action implements HttpPostActionInterface
{
    private ProductTypesRepositoryInterface $productTypesRepository;
    public function __construct(
        Context $context,
        ProductTypesRepositoryInterface $productTypesRepository
    )
    {
        parent::__construct($context);
        $this->productTypesRepository = $productTypesRepository;
    }

    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $productTypeId = (int)$this->getRequest()->getParam('id');

        if(!$productTypeId) {
            $this->messageManager->addErrorMessage(__('Error.'));
            return $resultRedirect->setPath('*/*/types');
        }

        try {
            $productType = $this->productTypesRepository->get($productTypeId);
            $this->productTypesRepository->delete($productType);
            $this->messageManager->addSuccessMessage(__('You deleted the product type.'));
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage(__('Cannot delete product type'));
        }

        return $resultRedirect->setPath('*/*/types');
    }
}
