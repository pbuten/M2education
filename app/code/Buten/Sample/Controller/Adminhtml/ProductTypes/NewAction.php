<?php


namespace Buten\Sample\Controller\Adminhtml\ProductTypes;


use Buten\Sample\Model\ProductTypesRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class NewAction extends Action
{
    /**
     * @see _isAlloved()
     */
    const ADMIN_RESOURCE = 'Magento_Catalog::catalog';
    private ProductTypesRepository $productTypesRepository;

    public function __construct(
        Context $context,
        ProductTypesRepository $productTypesRepository
    ) {
        parent::__construct($context);
        $this->productTypesRepository = $productTypesRepository;
    }


    public function execute(): ResultInterface
    {
        /** @var Page $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $result->setActiveMenu('AdvancedCoder_ProductTypes::advanced_coder')
            ->addBreadcrumb(__('New Product Type'), __('Product Type'));
        $result->getConfig()->getTitle()->prepend(__('New Product Type'));

        return $result;
    }
}
