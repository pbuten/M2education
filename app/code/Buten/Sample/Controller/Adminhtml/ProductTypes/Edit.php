<?php


namespace Buten\Sample\Controller\Adminhtml\ProductTypes;



use Buten\Sample\Model\ProductTypesRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Edit extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_Catalog::products';
    private ProductTypesRepository $productTypesRepository;
    public function __construct(
        Context $context,
        ProductTypesRepository $productTypesRepository
    ) {
        parent::__construct($context);
        $this->productTypesRepository = $productTypesRepository;
    }

    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $id = (int) $this->getRequest()->getParam('id');
        try {
            $type = $this->productTypesRepository->get($id);

            /** @var Page $result */
            $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $result->setActiveMenu('Buten_Sample::sample')
                ->addBreadcrumb(__('Edit Product Type'), __('Product Type'));
            $result->getConfig()
                ->getTitle()
                ->prepend(__('Edit Product Type: %type', ['type' => $type->getType()]));
        } catch (NoSuchEntityException $e) {
            /** @var Redirect $result */
            $result = $this->resultRedirectFactory->create();
            $this->messageManager->addErrorMessage(
                __('Product type with id "%value" does not exist.', ['value' => $id])
            );
            $result->setPath('*/*');
        }

        return $result;
    }
}
