<?php

declare(strict_types=1);
namespace Buten\Sample\Controller\Adminhtml\ProductTypes;


use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Types
 * @package Buten\Sample\Controller\Adminhtml\ProductTypes
 */
class Types extends Action
{
    /**
     * @see _isAlloved()
     */
    const ADMIN_RESOURCE = 'Magento_Catalog::catalog';
    protected $resultPageFactory;

    /**
     * Types constructor.
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Buten_Sample::sample')
            ->addBreadcrumb(__('Edit Product Type'), __('Product Type'));
        $resultPage->getConfig()->getTitle()->prepend(__('Product Types'));
        return $resultPage;
    }
}
