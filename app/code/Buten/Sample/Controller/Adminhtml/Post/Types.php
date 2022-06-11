<?php

declare(strict_types=1);
namespace Buten\Sample\Controller\Adminhtml\Post;


use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Types
 * @package Buten\Sample\Controller\Adminhtml\Post
 */
class Types extends Action
{
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
        $resultPage->getConfig()->getTitle()->prepend(__('Product Types'));
        return $resultPage;
    }
}
